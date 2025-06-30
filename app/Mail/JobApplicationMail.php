<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $jobPosting;

    /**
     * Create a new message instance.
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
        $this->jobPosting = $application->jobPosting;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Job Application Received')
            ->view('mail.job-application');
    }
} 