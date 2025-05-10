<?php

namespace App\Http\Middleware;

use App\Models\BusinessSetting;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckoutMiddleware
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
        $guestCheckoutSetting = BusinessSetting::where('type', 'guest_checkout_active')->first();

        if (!$guestCheckoutSetting || $guestCheckoutSetting->value != 1) {
            if (Auth::check()) {
                return $next($request);
            } else {
                session(['link' => url()->current()]);
                return redirect()->route('user.login');
            }
        }

        return $next($request);
    }
}
