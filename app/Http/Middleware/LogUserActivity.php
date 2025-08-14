<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        $data = [
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now()->toDateTimeString(),
            'user_id' => auth()->check() ? auth()->id() : null,
        ];

        Log::info('User Activity:', $data); // Logged in storage/logs/laravel.log

        return $next($request);
    }
}
