<?php

namespace App\Mail;

use App\Models\CompanySetting;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    private $first_name = 'Sir/Madam';
    private $otp = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name,$otp)
    {
        $this->first_name = $first_name;
        $this->otp = $otp;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Email Verification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $content = EmailTemplate::where('email_type','verify-email')->first('content')->content;
        $companyName = CompanySetting::first('name')->name;

        return new Content(
            view: 'admin.templates.templates-for-mails.email-verification-template',
            with: [
                'content' => $content,
                'companyName' => $companyName,
                'first_name' => $this->first_name,
                'otp' => $this->otp,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
