<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visit;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionId = session()->getId();
        $route = $request->path();

        // Verifica se esiste già una visita per questa sessione e rotta
        $existingVisit = Visit::where('session_id', $sessionId)
            ->where('route', $route)
            ->first();

        if (!$existingVisit) {
            Visit::create([
                'session_id' => $sessionId,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'route' => $route,
            ]);
        }

        return $next($request);
    }
}
