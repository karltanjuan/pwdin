<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class JobStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $job;

    /**
     * Create a new message instance.
     */
    public function __construct($job)
    {
        $this->job = $job;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('pwdin@gmail.com', 'PWDIn'),
            subject: 'PWDin - Job Account Update',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {       
        $status = "Close";
        $message = "";

        if ($this->job['status'] == 0) {
            $status = "Close";
            $message = "We regret to inform you that your job has been closed at this time. If you have any inquiries or concerns, please feel free to reach out to us at pwdin@gmail.com";
        } else if ($this->job['status'] == 1) {
            $status = "Open";
            $message = "Congratulations! The job has been re-opened.";
        }
         else if ($this->job['status'] == 2) {
            $status = "Rejected";
            $message = "We regret to inform you that your job has been rejected at this time. If you have any inquiries or concerns, please feel free to reach out to us at pwdin@gmail.com.";
        }

        return new Content(
            markdown: 'emails.job.update-job',
            with: [
                'username' => $this->job['username'],
                'email'    => $this->job['email'],
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
