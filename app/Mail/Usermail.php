<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Usermail extends Mailable
{
    use Queueable, SerializesModels;
    public $name, $email, $job, $status;
    /**
     * Create a new message instance.
     */

    // public function __construct($name,$email,$status,$job)
    // {
    //     $this->name = $name;
    //      $this->job = $job;
    //     $this->email = $email;
    //     $this->status = $status;
    //     //   $this->application = $application;
    //     // $this->job = $application->job;
    // }
    public function __construct($name, $email, $job, $status)
{
    $this->name = $name;
    $this->email = $email;
    $this->job = $job;
    $this->status = $status;
}

public function build()
{
    return $this->view('email.user')
        ->subject('Application Status Update')
        ->with([
            'name' => $this->name,
            'email' => $this->email,
            'job' => $this->job,
            'status' => $this->status, // ✅ Must be passed
        ]);
}
  


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Usermail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.user',
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

