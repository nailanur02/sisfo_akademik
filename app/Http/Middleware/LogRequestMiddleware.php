<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        Log::info('Request masuk', [
            'method' => $request->method(),
            'path' => $request->path(),
        ]);

        return $next($request);
    }
}