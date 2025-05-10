<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AdminLogMiddleware
{
    public function handle($request, Closure $next)
    {
        // Set default logging channel to admin
        Log::setDefaultDriver('admin');

        $response = $next($request);

        // Log the admin route access
        Log::info('[admin] ' . $request->method() . ' ' . $request->path(), [
            'user' => auth()->user() ? auth()->user()->id : 'guest',
            'ip' => $request->ip()
        ]);

        return $response;
    }
}
