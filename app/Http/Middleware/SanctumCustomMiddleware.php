<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SanctumCustomMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Define allowed origins
        $allowedOrigins = [
            'https://techsabrii.com',

        ];

        // Set CORS headers
        if (in_array($request->headers->get('Origin'), $allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $request->headers->get('Origin'));
        }

        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin, Authorization');

        // Handle preflight requests
        if ($request->getMethod() === "OPTIONS") {
            return response()->json([], 200);
        }

        return $response;
    }
}