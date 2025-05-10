<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;

class VerificationController extends Controller
{
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->middleware('auth');
        $this->emailService = $emailService;
    }

    /**
     * Show the email verification notice.
     *
     * @return \Illuminate\Http\Response
     */
    public function notice()
    {
        // If user is already verified, redirect to home
        if (Auth::user()->email_verified_at) {
            return redirect()->route('index');
        }

        return view('auth.verify');
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        $user = Auth::user();

        // If user is already verified, redirect
        if ($user->email_verified_at) {
            Flash::success('Your email is already verified.');
            return redirect()->route('index');
        }

        // Generate new verification token if not exists
        if (!$user->verification_token) {
            $user->verification_token = Str::random(64);
            $user->save();
        }

        // Send verification email using EmailService
        $this->emailService->send(
            'verify',
            [
                'user' => $user,
                'token' => $user->verification_token
            ],
            $user->email,
            'Verify Your Email Address'
        );

        Flash::success('Verification link has been sent to your email address.');
        return back();
    }
}