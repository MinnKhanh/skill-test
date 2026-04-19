<?php

namespace App\Factories;

use App\Services\Admin\AuthService;
use App\Services\Admin\MasterDataService;
use App\Services\Admin\User\UserService;
use App\Services\Admin\User\UserTableService;

class AdminFactory
{
    /**
     * Register Admin Service
     *
     * @param Application|Container $app
     * @return void
     */
    public static function register($app): void
    {
        $app->scoped(AuthService::class, function ($app) {
            return new AuthService();
        });

        $app->scoped(MasterDataService::class, function ($app) {
            return new MasterDataService();
        });

        $app->scoped(UserTableService::class, function ($app) {
            return new UserTableService();
        });

        $app->scoped(UserService::class, function ($app) {
            return new UserService();
        });
    }

    /**
     * Get Master Data Service
     *
     * @return MasterDataService
     */
    public static function getMasterDataService()
    {
        return app(MasterDataService::class);
    }

    /**
     * Get Auth Service
     *
     * @return AuthService
     */
    public static function getAuthService()
    {
        return app(AuthService::class);
    }

    /**
     * Get User Service
     *
     * @return UserService
     */
    public static function getUserService()
    {
        return app(UserService::class);
    }

    /**
     * Get User Table Service
     *
     * @return UserTableService
     */
    public static function getUserTableService()
    {
        return app(UserTableService::class);
    }
}
