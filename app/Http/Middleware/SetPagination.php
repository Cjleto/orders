<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetPagination
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $perPage = $request->query('per_page', config('myconst.pagination.default', 10));

        // Assicuriamoci che sia un numero valido
        $perPage = is_numeric($perPage) && $perPage > 0 ? (int) $perPage : 10;

        // Impostiamo il valore globalmente nella request
        $request->merge(['per_page' => $perPage]);

        return $next($request);
    }
}
