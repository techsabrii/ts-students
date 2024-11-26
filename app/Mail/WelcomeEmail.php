<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use SerializesModels;

    public $randomPassword;
    public $signInLink;

    public function __construct($randomPassword, $signInLink)
    {
        $this->randomPassword = $randomPassword;
        $this->signInLink = $signInLink;
    }

    public function build()
    {
        return $this->subject('Welcome to Our Platform!')
                    ->view('emails.welcome');
    }
}
