<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\BusinessSetting;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laracasts\Flash\Flash;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->middleware('guest');
        $this->emailService = $emailService;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'h-captcha-response' => ['required']
        ]);
    }

    protected function create(array $data)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'email_verified_at' => $this->shouldAutoVerifyEmail() ? now() : null
            ]);

            Customer::create([
                'user_id' => $user->id
            ]);

            $this->handleReferralCode($user);
           
            if (!$this->shouldAutoVerifyEmail()) {
                $user->sendEmailVerificationNotification();
            }

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'verification_token' => Str::random(64),
                'email_verified_at' => null
            ]);

            Customer::create([
                'user_id' => $user->id
            ]);
            // Using the EmailService
            $this->emailService->send(
                'verify',
                [
                    'user' => $user,
                    'token' => $user->verification_token
                ],
                $user->email,
                'Verify Your Email Address'
            );

            return $user;
        });

        auth()->login($user);
        Flash::success('Registration successful! Please verify your email address.');
        return redirect()->route('index');
    }


    protected function registered(Request $request, $user)
    {
        return redirect()->route('dashboard')
            ->with('flash_notification', [
                [
                    'level' => 'success',
                    'message' => 'Registration successful! Welcome to our platform.'
                ]
            ]);
    }

    private function shouldAutoVerifyEmail(): bool
    {
        return BusinessSetting::where('type', 'email_verification')
            ->first()
            ->value != 1;
    }

    private function verifyCaptcha(string $token): bool
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://hcaptcha.com/siteverify', [
            'form_params' => [
                'secret' => config('services.hcaptcha.secret'),
                'response' => $token,
                'remoteip' => request()->ip()
            ]
        ]);

        return json_decode($response->getBody())->success;
    }

    private function handleReferralCode(User $user): void
    {
        if ($referralCode = request()->cookie('referral_code')) {
            $referrer = User::where('referral_code', $referralCode)->first();
            if ($referrer) {
                $user->update(['referred_by' => $referrer->id]);
            }
        }
    }

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->verification_token = null;
            $user->save();

            Flash::success('Email verified successfully! You can now login.');
            return redirect()->route('dashboard');
        }

        Flash::error('Invalid verification token.');
        return redirect()->route('index');
    }
}
