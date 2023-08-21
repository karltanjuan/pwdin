<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ApplicantStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $applicant;

    /**
     * Create a new message instance.
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('pwdin@gmail.com', 'PWDIn'),
            subject: 'PWDin - Applicant Account Update',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {       
        $status = "Pending";
        $message = "";

        if ($this->applicant['status'] == 0) {
            $status = "Pending";
            $message = "Welcome to PWDIn. Thank you for your registration. Please wait for up to 3 days for your applicant account to be verified.";
        } else if ($this->applicant['status'] == 1) {
            $status = "Approved";
            $message = "Congratulations! You have been approved and are now able to log in and browse a wider range of job opportunities. We wish you all the best in your job hunting journey! Remember, the sky's the limit, and we're here to support you every step of the way. Happy job hunting!";
        }
         else if ($this->applicant['status'] == 2) {
            $status = "Rejected";
            $message = "We regret to inform you that your application has been rejected at this time. If you have any inquiries or concerns, please feel free to reach out to us at pwdin@gmail.com.";
        }

        return new Content(
            markdown: 'emails.applicant.update-account',
            with: [
                'username' => $this->applicant['username'],
                'email'    => $this->applicant['email'],
                'status'   => $status,
                'message'  => $message
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
