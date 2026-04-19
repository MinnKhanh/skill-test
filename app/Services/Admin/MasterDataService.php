<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Services\Base\MasterDataService as BaseMasterDataService;

class MasterDataService extends BaseMasterDataService
{
    /**
     * @var array
     */
    protected $availableResources = [
        'users' => [
            'driver' => self::DRIVER_ELOQUENT,
            'target' => User::class,
            'select' => ['id', 'name'],
        ],
    ];
}
