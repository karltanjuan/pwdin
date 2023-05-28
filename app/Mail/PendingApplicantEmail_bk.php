<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingApplicantEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $username;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $email)
    {
        $this->username = $username;
        $this->email    = $email;
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('pwdin@gmail.com')
            ->to($this->email)
            ->markdown('email.applicant.pending-account')
            ->with([
                'username' => $this->username,
                'email'    => $this->email
            ])
            ->subject("PWDin - Pending Account for Registration");
    }
}
