<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;

class SendTestEmail extends Mailable
{
    public $email;
    public $mailContent;

    public function __construct($email)
    {
        $this->email = $email;

        $this->mailContent = DB::table('configurations')
            ->where('id', 1)
            ->value('mail_content');
    }

    public function build()
    {
        // return $this->view('emails.registration')
        //             ->subject('Test Email Subject Baseus');

        return $this->subject("BASEUS CONNECT - REGISTRATION CONFIRMATION")
                    ->from('no-reply@baseusconnect.id', 'Baseus Connect - No Reply')
                    ->view('emails.registration') // Link to your HTML view
                    ->with([
                        'email' => $this->email,
                        'mailContent' => $this->mailContent
                    ]);
    }
}
