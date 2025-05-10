<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        // Retrieve user from provider
        $user = Socialite::driver($provider)->user();

        // Check if the user already exists
        $existingUser = User::where('provider_id', $user->id)
            ->orWhere('email', $user->email)
            ->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => now(),
                'provider_id' => $user->id,
            ]);

            Customer::create([
                'user_id' => $newUser->id
            ]);

            auth()->login($newUser, true);
        }

        return redirect()->intended(session('link') ?? route('dashboard'));
    }

    protected function credentials(Request $request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return $request->only($this->username(), 'password');
        }

        return [
            'phone' => $request->get('email'),
            'password' => $request->get('password')
        ];
    }

    public function authenticated()
    {
        if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(session('link') ?? route('dashboard'));
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $credentials = $this->credentials($request);

        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            Flash::error('Invalid email or password. Please try again.');
        } else {
            Flash::error('Invalid phone number or password. Please try again.');
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'));
    }

    public function logout(Request $request)
    {
        $redirect_route = auth()->user()?->user_type == 'admin' || auth()->user()?->user_type == 'staff'
            ? 'login'
            : 'index';

        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($redirect_route);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
