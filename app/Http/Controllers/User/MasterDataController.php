<?php

namespace App\Http\Controllers\User;

use App\Factories\UserFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MasterDataController extends BaseController
{
    /**
     * Master data
     * @unauthenticated
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $resources = $request->input('resources');

        if (!is_array($resources)) {
            return $this->sendSuccessResponse([]);
        }

        $data = UserFactory::getMasterDataService()->withResources($resources)->get();
        return $this->sendSuccessResponse($data);
    }
}
