<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect()->route('home');
        // }

        if ($request->isMethod('get') && ($request->is('login') || $request->is('register'))) {
            return redirect()->route('user.login');
        }

        return $next($request);
    }
}
