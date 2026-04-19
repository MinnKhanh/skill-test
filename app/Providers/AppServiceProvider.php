<?php

namespace App\Providers;

use App\Factories\AdminFactory;
use App\Factories\CommonFactory;
use App\Factories\UserFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Routing\Route;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Scramble;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        AdminFactory::register($this->app);
        CommonFactory::register($this->app);
        UserFactory::register($this->app);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Scramble::configure()
            ->withDocumentTransformers(function (OpenApi $openApi) {
                $openApi->secure(
                    SecurityScheme::http('bearer'),
                );
            })
            ->routes(function (Route $route) {
                $apiBasePaths = ['admin', 'api'];
                foreach ($apiBasePaths as $path) {
                    if (Str::startsWith($route->uri, $path)) {
                        return true;
                    }
                }

                return false;
            });
    }
}
