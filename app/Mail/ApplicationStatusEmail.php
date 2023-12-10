<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $status;
    protected $rejected_reason;
    protected $is_rejected;
    protected $username;
    protected $job_title;
    protected $company_name;

    /**
     * Create a new message instance.
     */
    public function __construct($status, $rejected_reason, $is_rejected, $username, $job_title, $company_name)
    {
        $this->status          = $status;
        $this->rejected_reason = $rejected_reason;
        $this->is_rejected     = $is_rejected;
        $this->username        = $username;
        $this->job_title       = $job_title;
        $this->company_name    = $company_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('pwdin@gmail.com', 'PWDIn'),
            subject: 'PWDin - Application Update',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {       
        $statuses = ["Applied", "Initial Interview", "Exam", "Final Interview", "Hired", "Rejected"];
        $message  = "";

        if (in_array($this->status, $statuses)) {
            switch ($this->status) {
                case 'Applied':
                    $message = "Thank you for applying for the {$this->job_title} role at {$this->company_name}! We have received your application and will review it shortly.";
                    break;
                case 'Initial Interview':
                    $message = "Congratulations on reaching the initial interview stage for the {$this->job_title} role at {$this->company_name}! We will be in touch to schedule your interview soon.";
                    break;
                case 'Exam':
                    $message = "You have an upcoming exam for the {$this->job_title} role at {$this->company_name}. Good luck!";
                    break;
                case 'Final Interview':
                    $message = "You are scheduled for the final interview for the {$this->job_title} role at {$this->company_name}. Prepare well!";
                    break;
                case 'Hired':
                    $message = "Congratulations for the {$this->job_title} role at {$this->company_name}! You have been hired. Welcome aboard!";
                    break;
                case 'Rejected':
                    $this->rejected_reason = strtolower($this->rejected_reason);
                    $message = "We appreciate your interest, but unfortunately, you have not been selected this time for the {$this->job_title} role at {$this->company_name} because {$this->rejected_reason}.";
                    break;
                default:
                    $message = "";
                    break;
            }
        } else {
            $message = "Invalid status";
        }
         

        return new Content(
            markdown: 'emails.applicant.application-status',
            with: [
                'username'     => $this->username,
                'company_name' => $this->company_name,
                'job_title'    => $this->job_title,
                'message'      => $message
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
