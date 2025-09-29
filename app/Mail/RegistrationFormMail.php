<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class RegistrationFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $mailContent;
    public $groupLink;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $groupLink)
    {
        $this->email    = $email;

        $this->mailContent = DB::table('configurations')
            ->where('id', 1)
            ->value('mail_content');

        $this->groupLink = $groupLink;
    }

    public function build()
    {
        return $this->subject("BASEUS CONNECT - REGISTRATION CONFIRMATION")
                    ->from('no-reply@baseusconnect.id', 'Baseus Connect - No Reply')
                    ->view('emails.registration') // Link to your HTML view
                    ->with([
                        'email' => $this->email,
                        'mailContent' => $this->mailContent,
                        'groupLink' => $this->groupLink
                    ]);
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'BASEUS CONNECT - REGISTRATION CONFIRMATION',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.registration',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
