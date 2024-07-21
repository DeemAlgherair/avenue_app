<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RestPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $token;
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($name,$token,$email)
    {
        $this->name = $name;
        $this->token = $token;
        $this->email = $email;


    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rest Password Token',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Backend.auth..mail.resetMail',
            with : [
                'name'=> $this->name,
                'token'=> $this->token,
                'email'=> $this->email,

            ]
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
