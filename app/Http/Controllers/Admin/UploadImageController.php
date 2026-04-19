<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\InputException;
use App\Factories\CommonFactory;
use App\Http\Requests\Admin\UploadImageRequest;
use Illuminate\Http\JsonResponse;

class UploadImageController extends BaseController
{
    /**
     * UploadController constructor.
     */
    public function __construct()
    {
        $this->middleware($this->authMiddleware());
    }

    /**
     * Upload an image and return URL
     *
     * @param UploadImageRequest $request
     * @return JsonResponse
     * @throws InputException
     */
    public function upload(UploadImageRequest $request): JsonResponse
    {
        $data = CommonFactory::getFileService()->uploadImage($request->file('image'), $request->input('type'));

        return $this->sendSuccessResponse($data);
    }
}
