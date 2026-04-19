<?php

namespace App\Http\Controllers\Admin;

use App\Factories\AdminFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MasterDataController extends BaseController
{
    /**
     * MasterDataController constructor.
     */
    public function __construct()
    {
        $this->middleware($this->authMiddleware());
    }

    /**
     * Get requested master data resources
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

        $data = AdminFactory::getMasterDataService()->withResources($resources)->get();

        return $this->sendSuccessResponse($data);
    }
}
