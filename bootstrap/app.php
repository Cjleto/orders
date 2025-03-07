<?php

use App\Http\Middleware\DebugbarMiddleware;
use App\Http\Middleware\SetPagination;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
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
        //
    })->create();
