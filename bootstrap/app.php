<?php

use Illuminate\Http\Request;
use App\Helpers\RequestHelper;
use App\Helpers\ResponseHelper;
use App\Exceptions\InputException;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands : __DIR__.'/../routes/console.php',
        using: function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('api')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectTo(guests: '/', users: '/');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if (RequestHelper::isApi($request)) {
                return ResponseHelper::sendResponse(ResponseHelper::STATUS_CODE_NOTFOUND, trans('response.not_found'));
            }
        });
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if (RequestHelper::isApi($request)) {
                return ResponseHelper::sendResponse(ResponseHelper::STATUS_CODE_UNAUTHORIZED, trans('response.unauthenticated'));
            }
        });
        $exceptions->dontReport([InputException::class]);
        $exceptions->render(function (InputException $e, Request $request) {
            if (RequestHelper::isApi($request)) {
                return ResponseHelper::sendResponse(ResponseHelper::STATUS_CODE_BAD_REQUEST, $e->getMessage());
            }
        });
        $exceptions->dontReport([NotFoundException::class]);
        $exceptions->render(function (NotFoundException $e, Request $request) {
            if (RequestHelper::isApi($request)) {
                return ResponseHelper::sendResponse(ResponseHelper::STATUS_CODE_NOTFOUND, $e->getMessage());
            }
        });
        $exceptions->render(function (ValidationException $exception, $request) {
            return ResponseHelper::sendResponse(
                $exception->status,
                trans('response.invalid'),
                $exception->errors(),
            );
        });
    })->create();
