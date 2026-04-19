<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Exceptions\InputException;
use App\Factories\AdminFactory;
use App\Http\Resources\Admin\User\UserCollection;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Http\Resources\Admin\User\UserDetailResource;

class UserController extends BaseController
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware($this->authMiddleware());
    }

    /**
     * Get list of users with pagination and filters
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        [$search, $orders, $filters, $perPage] = $this->convertRequest($request);
        $data = AdminFactory::getUserTableService()->data($search, $orders, $filters, $perPage);

        return $this->sendSuccessResponse(new UserCollection($data));
    }

    /**
     * Get user detail by ID
     *
     * @param $id
     * @return JsonResponse
     * @throws InputException
     */
    public function detail($id): JsonResponse
    {
        $data = AdminFactory::getUserService()->detail($id);

        return $this->sendSuccessResponse(new UserDetailResource($data));
    }

    /**
     * Update user information
     *
     * @param $id
     * @param UserUpdateRequest $request
     * @return JsonResponse
     * @throws InputException
     */
    public function update($id, UserUpdateRequest $request): JsonResponse
    {
        $inputs = $request->only([
            'name',
            'email',
            'status',
        ]);
        $data = AdminFactory::getUserService()->update($id, $inputs);

        return $this->sendSuccessResponse($data, trans('response.updated', [
            'object' => trans('response.label.user'),
        ]));
    }
}
