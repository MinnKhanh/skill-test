<?php

namespace App\Services\Admin\User;

use App\Exceptions\NotFoundException;
use App\Models\User;
use App\Services\Base\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserService extends Service
{
    /**
     * Detail user
     *
     * @param $id
     * @return Builder|Model|object
     * @throws NotFoundException
     */
    public function detail($id)
    {
        $user = User::query()
            ->where('id', '=', $id)
            ->first();
        if (!$user) {
            throw new NotFoundException(trans('response.not_found'));
        }

        return $user;
    }

    /**
     * Update user
     *
     * @param $id
     * @param array $data
     * @return bool|int
     * @throws NotFoundException
     */
    public function update($id, array $data): bool|int
    {
        $user = User::query()
            ->where('id', '=', $id)
            ->first();
        if (!$user) {
            throw new NotFoundException(trans('response.not_found'));
        }

        return $user->update($data);
    }
}
