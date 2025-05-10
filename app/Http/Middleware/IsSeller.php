<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsSeller
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type == 'seller') {
            return $next($request);
        }
        abort(404);
    }
}
