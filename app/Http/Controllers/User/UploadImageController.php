<?php

namespace App\Http\Controllers\User;

use App\Exceptions\InputException;
use App\Factories\CommonFactory;
use App\Http\Requests\User\UploadImageRequest;
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
     * Upload image
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
