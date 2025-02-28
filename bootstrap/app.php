<?php

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\TrackVisit;
use Illuminate\Foundation\Application;
use App\Http\Middleware\DebugbarMiddleware;
use App\Http\Middleware\MissingMenuSettings;
use App\Http\Middleware\ExistsOneVisibleDish;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            DebugbarMiddleware::class,
        ]);

        $middleware->alias([
            'missingMenuSetting' => MissingMenuSettings::class,
            'existsOneVisibleDish' => ExistsOneVisibleDish::class,
            'setLocale' => SetLocale::class,
            'registerVisit' => TrackVisit::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
