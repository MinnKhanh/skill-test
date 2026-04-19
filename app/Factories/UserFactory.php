<?php

namespace App\Factories;

use App\Services\User\AuthService;
use App\Services\User\MasterDataService;

class UserFactory
{
    /**
     * Register User Service
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
}
