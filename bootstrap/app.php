<?php

use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use App\Http\Middleware\SetPagination;
use Illuminate\Foundation\Application;
use App\Http\Middleware\DebugbarMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api_v1.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            DebugbarMiddleware::class,
        ]);

        $middleware->api(append: [
            SetPagination::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            return CustomException::withMessage('Resource Not Found', $e->getStatusCode())->render($request);
        });

        $exceptions->renderable(function (Exception $e, Request $request) {

            return CustomException::withMessage($e->getMessage(), $e->getCode())->render($request);

        });
    })->create();
