<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class EmployerStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $employer;

    /**
     * Create a new message instance.
     */
    public function __construct($employer)
    {
        $this->employer = $employer;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('pwdin@gmail.com', 'PWDIn'),
            subject: 'PWDin - Employer Account Update',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {       
        $status = "Pending";
        $message = "";

        if ($this->employer['status'] == 0) {
            $status = "Pending";
            $message = "Welcome to PWDIn. Thank you for your registration. Please wait for up to 3 days for your employer account to be verified.";
        } else if ($this->employer['status'] == 1) {
            $status = "Approved";
            $message = "Congratulations! Your employer account has been successfully approved. You can now access your account, post new job opportunities, and connect with potential candidates. We're excited to have you on board and look forward to your contributions to our platform. If you have any questions or need assistance, feel free to reach out to us. Happy recruiting!";
        }
         else if ($this->employer['status'] == 2) {
            $status = "Rejected";
            $message = "We regret to inform you that your employer account application has not been approved at this time. We appreciate your interest in joining our platform. If you have any inquiries or would like further clarification, please don't hesitate to contact us at pwdin@gmail.com. Thank you for considering us, and we wish you the best in your endeavors.";
        }

        return new Content(
            markdown: 'emails.employer.update-account',
            with: [
                'username' => $this->employer['username'],
                'email'    => $this->employer['email'],
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
