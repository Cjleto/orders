<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use Symfony\Component\HttpFoundation\Response;

class DebugbarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Debugbar::disable();

        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                Debugbar::enable();
            }
        }

        if (config('app.env') === 'local' && config('app.debug')) {
            Debugbar::enable();
        }


        return $next($request);
    }
}
