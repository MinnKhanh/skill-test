<?php

namespace App\Factories;

use App\Services\Common\FileService;
use App\Services\Common\RecaptchaService;

class CommonFactory
{
    /**
     * Register Common Service
     *
     * @param Application|Container $app
     * @return void
     */
    public static function register($app): void
    {
        $app->scoped(FileService::class, function ($app) {
            return new FileService();
        });
        $app->scoped(RecaptchaService::class, function ($app) {
            return new RecaptchaService();
        });
    }

    /**
     * Get File Service
     *
     * @return FileService
     */
    public static function getFileService()
    {
        return app(FileService::class);
    }

    /**
     * Get reCAPTCHA Service
     *
     * @return RecaptchaService
     */
    public static function getRecaptchaService()
    {
        return app(RecaptchaService::class);
    }
}
