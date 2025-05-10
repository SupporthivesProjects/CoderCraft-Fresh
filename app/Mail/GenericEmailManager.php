<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericEmailManager extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build()
    {
        return $this->view($this->emailData['view'])    
                    // ->cc($this->emailData['cc'])
                    ->from($this->emailData['from'])
                    ->subject($this->emailData['subject'])
                    ->with(['data' => $this->emailData['data']]);
    }
}
