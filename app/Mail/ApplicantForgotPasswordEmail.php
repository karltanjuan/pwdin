<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ApplicantForgotPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $username;
    protected $email;
    protected $token;
    protected $operating_system;
    protected $browser;

    /**
     * Create a new message instance.
     */
    public function __construct(string $username, string $email, string $token, string $operating_system, string $browser)
    {
        $this->username         = $username;
        $this->email            = $email;
        $this->token            = $token;
        $this->operating_system = $operating_system;
        $this->browser          = $browser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('pwdin@gmail.com', 'PWDIn'),
            subject: 'PWDin - Reset Password Link',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.applicant.forgot-password',
            with: [
                'username'         => $this->username,
                'email'            => $this->email,
                'token'            => $this->token,
                'operating_system' => $this->operating_system,
                'browser'          => $this->browser,
            ],
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
