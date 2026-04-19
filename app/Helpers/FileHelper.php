<?php

namespace App\Helpers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelper
{
    /**
     * Full Path Not Domain
     *
     * @param $path
     * @return string|null
     */
    public static function fullPathNotDomain($path): ?string
    {
        if (!$path) {
            return null;
        }

        $urlParsed = parse_url($path);

        return trim($urlParsed['path'] ?? '', '/');
    }

    /**
     * Get Full Url
     *
     * @param $path
     * @return string|null
     */
    public static function getFullUrl($path): ?string
    {
        if (!$path) {
            return null;
        }

        $newPath = strstr($path, config('upload.path_origin_image'));

        return self::storageImages()->url($newPath);
    }

    /**
     * @param $path
     * @return string|null
     */
    public static function getFullUrlThumb($path): ?string
    {
        if (!$path) {
            return null;
        }

        $getPathThumb = str_replace(config('upload.path_origin_image'), config('upload.path_thumbnail'), $path);
        $newPathThumb = strstr($getPathThumb, config('upload.path_thumbnail'));

        return self::storageImages()->url($newPathThumb);
    }

    /**
     * Storage Images
     *
     * @return Filesystem
     */
    public static function storageImages(): Filesystem
    {
        $diskName = config('upload.image_disk');

        return Storage::disk($diskName);
    }

    /**
     * Get File Webp Name
     *
     * @param null $baseName
     * @param null $fileExtension
     * @return string
     */
    public static function constructFileName($baseName = null, $fileExtension = null): string
    {
        if ($baseName) {
            $pathInfo = pathinfo($baseName);
            $fileName = Str::slug($pathInfo['filename']) . '-' . StringHelper::uniqueCode(8);
        } else {
            $fileName = StringHelper::uniqueCode(20);
        }

        $fileExtension = $fileExtension ?? config('upload.webp_ext');

        return Str::lower($fileName . '.' . $fileExtension);
    }

    /**
     * Path Url
     *
     * @param $fileName
     * @param $namePath
     * @return string
     */
    public static function pathUrl($fileName, $namePath): string
    {
        return $namePath . '/' . $fileName;
    }
}
