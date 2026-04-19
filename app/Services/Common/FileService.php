<?php

namespace App\Services\Common;

use App\Services\Base\Service;
use App\Helpers\FileHelper;
use App\Models\Image as Images;
use Illuminate\Http\UploadedFile;
use App\Exceptions\InputException;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

class FileService extends Service
{
    /**
     * @var string
     */
    protected $diskName;

    /**
     * @var Filesystem
     */
    protected $storage;

    /**
     * @return Filesystem
     */
    private function storage(): Filesystem
    {
        if (!$this->storage) {
            $this->storage = Storage::disk($this->diskName);
        }

        return $this->storage;
    }

    /**
     * Upload image
     *
     * @param UploadedFile $file
     * @param $type
     * @return array
     * @throws InputException
     */
    public function uploadImage(UploadedFile $file, $type): array
    {
        $this->diskName = config('upload.image_disk');

        $fileName = FileHelper::constructFileName($file->getClientOriginalName());

        [$fullPath, $thumbPath] = $this->resizeImage($file, $type, $fileName);

        $image = Images::query()->create([
            'imageable_id' => $this->user->id ?? null,
            'imageable_type' => $this->user ? get_class($this->user) : null,
            'url' => $fullPath,
            'thumb' => $thumbPath,
            'type' => $type,
        ]);

        $imageUrl = $this->storage()->url($image->url);
        $thumbnailUrl = $this->storage()->url($image->thumb);

        return ['url' => $imageUrl, 'thumb' => $thumbnailUrl, 'type' => $image->type, 'id' => $image->id];
    }

    /**
     * Fake image
     *
     * @param $type
     * @return array
     * @throws InputException
     */
    public function fakeImage($type): array
    {
        $this->diskName = config('upload.image_disk');
        $typeImage = config('upload.image_types' . '.' . $type);
        $imageUrl = 'https://via.placeholder.com/' . $typeImage['full_size'][0] . 'x' . $typeImage['full_size'][0] . '.png';

        $fileName = FileHelper::constructFileName();

        [$fullPath, $thumbPath] = $this->resizeImage($imageUrl, $type, $fileName);

        $image = Images::query()->create([
            'imageable_id' => $this->user->id ?? null,
            'imageable_type' => $this->user ? get_class($this->user) : null,
            'url' => $fullPath,
            'thumb' => $thumbPath,
            'type' => $type,
        ]);

        $imageUrl = $this->storage()->url($image->url);
        $thumbnailUrl = $this->storage()->url($image->thumb);

        return ['url' => $imageUrl, 'thumb' => $thumbnailUrl];
    }

    /**
     * Resize
     *
     * @param $image
     * @param $type
     * @param $fileName
     * @return false[]|string[]
     * @throws InputException
     */
    protected function resizeImage($image, $type, $fileName): array
    {
        $img = Image::read($image);
        $typeImage = config('upload.image_types' . '.' . $type);

        if (!$typeImage) {
            throw new InputException(trans('validation.upload_error_type'));
        }

        $fullPath = FileHelper::pathUrl($fileName, config('upload.path_origin_image'));
        $thumbPath = FileHelper::pathUrl($fileName, config('upload.path_thumbnail'));

        $imageOrigin = $img;
        $imageThumb = clone $img;

        if ($typeImage['crop']) {
            $deltaOld = $typeImage['full_size'][0] / $typeImage['full_size'][1];
            $deltaNew = $img->width() / $img->height();

            if ($deltaOld >= $deltaNew) {
                $width = $img->width();
                $height = $width / $deltaOld;
            } else {
                $height = $img->height();
                $width = $height * $deltaOld;
            }

            $img = $img->crop((int) $width, (int) $height);

            // Resize keeping aspect ratio without upscaling
            $imageOrigin = $img->scaleDown($typeImage['full_size'][0]);

            $imageThumb = clone $img;
            $imageThumb = $imageThumb->scaleDown($typeImage['thumb_size'][0]);
        }

        $encodeType = strtolower((string) config('upload.webp_ext', 'webp'));
        $webpQuality = (int) config('upload.webp_quality', 80);

        // Encode using Intervention Image v3 encoders
        switch ($encodeType) {
            case 'jpg':
            case 'jpeg':
                $originBinary = $imageOrigin->toJpeg($webpQuality);
                $thumbBinary = $imageThumb->toJpeg($webpQuality);
                break;
            case 'png':
                $originBinary = $imageOrigin->toPng();
                $thumbBinary = $imageThumb->toPng();
                break;
            case 'webp':
            default:
                $originBinary = $imageOrigin->toWebp($webpQuality);
                $thumbBinary = $imageThumb->toWebp($webpQuality);
                break;
        }

        $this->storage()->put($fullPath, $originBinary);
        $this->storage()->put($thumbPath, $thumbBinary);

        return [$fullPath, $thumbPath];
    }
}
