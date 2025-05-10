<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Services\EmailService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laracasts\Flash\Flash;

class ContactUSController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function contactUS()
    {
        try {
            return view('frontend.contact_us');
        } catch (\Exception $e) {
            Log::error('Error loading contact page: ' . $e->getMessage());
            Flash::error('Unable to load contact page. Please try again.');
            return redirect()->route('index');
        }
    }

    private function validateIpSubmissions(Request $request)
    {
        $ip = $request->ip();
        if (!$ip) {
            Flash::error('Invalid user detected. Please try again with a valid connection.');
            throw new \Exception('Invalid user detected');
        }

        $todaySubmissions = ContactUs::ipSubmissionsToday($ip);

        if ($todaySubmissions >= 4) {
            Flash::warning('Daily submission limit reached. Please try again tomorrow.');
            throw new \Exception('Daily submission limit reached. Please try again tomorrow.');
        }

        return $ip;
    }


    public function contactSaveData(Request $request)
    {
        try {
            $this->validateRequest($request);

            // if (!$request->input('h-captcha-response')) {
            //     Flash::error('Please complete the captcha verification');
            //     return back()->withInput();
            // }
            // $this->verifyCaptcha($request);

            try {
                $ip = $this->validateIpSubmissions($request);
            } catch (\Exception $e) {
                // Specifically catch and display the IP submission limit error
                if (strpos($e->getMessage(), 'Daily submission limit reached') !== false) {
                    Flash::warning($e->getMessage());
                    return back()->withInput();
                }
                throw $e; // Re-throw if it's a different error
            }

            $contactData = $this->processContactData($request);
            $attachment = $this->handleFileUpload($request);

            // Add IP and timestamp to contact data
            $contactData['ip_address'] = $ip;
            $contactData['submitted_at'] = Carbon::now();

            DB::transaction(function () use ($contactData, $attachment) {
                ContactUs::create(array_merge($contactData, ['attachment' => $attachment]));

                // Send email to admin
                $this->emailService->send(
                    'contact',
                    $contactData,
                    env('ADMIN_EMAIL', 'support@lingosphere.co'),
                    $this->getEmailSubject($contactData['from_page'])
                );

                // Send acknowledgement to user
                $this->emailService->send(
                    'acknowledge',
                    $contactData,
                    $contactData['email'],
                    'Thank you for contacting us'
                );
            });

            Flash::success('Your message has been sent successfully!');
            return back()->with($this->getSuccessMessage($request->from_page));
        } catch (ValidationException $e) {
            Flash::error('Please check your input and try again.');
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Contact form submission error: ' . $e->getMessage());
            Flash::error('Unable to process your request. Please try again later.');
            return back()->withInput();
        }
    }


    private function validateRequest(Request $request)
    {
        try {
            $rules = [
                'fullname' => 'required',
                'email' => 'required|email',
                'message' => 'required'
            ];

            if ($request->from_page == 'contactus') {
                $rules['phone'] = 'required';
            }

            // For the WDD page form (service page)
            if ($request->from_page == 'service') {
                $rules['phone'] = 'required';
                $rules['document'] = 'required|file|max:10240'; // 10MB max file size
            }

            return $request->validate($rules);
        } catch (\Exception $e) {
            throw new ValidationException($e);
        }
    }

    private function verifyCaptcha(Request $request)
    {
        try {
            $client = new \GuzzleHttp\Client([
                'verify' => base_path('cacert.pem')
            ]);
            $response = $client->post('https://hcaptcha.com/siteverify', [
                'form_params' => [
                    'secret' => env('H_CAPTCHA_SECRET_KEY'),
                    'response' => $request->input('h-captcha-response'),
                    'remoteip' => $request->ip()
                ]
            ]);

            if (!json_decode($response->getBody())->success) {
                throw new \Exception('Captcha verification failed');
            }
        } catch (\Exception $e) {
            Log::error('Captcha verification error: ' . $e->getMessage());
            throw new \Exception('Unable to verify captcha. Please try again.');
        }
    }


    private function handleFileUpload(Request $request)
    {
        try {
            if (!$request->hasFile('document')) {
                // For service page form, document is required
                if ($request->from_page == 'service') {
                    throw new \Exception('Document upload is required');
                }
                return null;
            }

            $file = $request->file('document');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .
                '_' . time() . '.' .
                $file->getClientOriginalExtension();

            $file->move(public_path('uploads/documents'), $fileName);
            return 'uploads/documents/' . $fileName;
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            throw new \Exception('Unable to upload file. Please try again.');
        }
    }

    private function processContactData(Request $request)
    {
        $data = [
            'from_page' => $request->from_page,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'message' => $request->message
        ];

        if ($request->has('phone')) {
            $data['phone'] = $request->phone;
        }

        if ($request->has('service')) {
            $data['service'] = $request->service;
        }

        return $data;
    }


    private function getEmailSubject($fromPage)
    {
        $subjects = [
            'contactus' => 'Message from Contact Us page',
            'aboutus' => 'Message from About Us page',
            'languages' => 'Message from Languages page',
            'documents' => 'Message from Documents page',
            'service' => 'Message from Web Design & Development Page',
            'bespoke_service' => 'Message from Bespoke Service Page'
        ];

        return $subjects[$fromPage] ?? 'New Contact Message';
    }

    private function getSuccessMessage($fromPage)
    {
        return $fromPage == 'contactus' ? 'contactsuccess' : 'packagesuccess';
    }
}
