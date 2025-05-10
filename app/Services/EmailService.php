<?php

namespace App\Services;

use App\Mail\GenericEmailManager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function send($type, $data, $to, $subject)
    {
        $emailData = [
            'view' => "emails.{$type}",
            'subject' => $subject,
            'data' => $data,
            'from' => env('MAIL_FROM_ADDRESS')
        ];
        try {
            Mail::to($to)->queue(new GenericEmailManager($emailData));
            return true;
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return false;
        }
    }
}