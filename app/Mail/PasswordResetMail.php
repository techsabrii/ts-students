<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use SerializesModels;

    public $password;
    public $email;

    // Constructor to pass the new password and email
    public function __construct($password, $email)
    {
        $this->password = $password;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Your Password Has Been Reset')
                    ->view('emails.password_reset'); // View to render the email
    }
}
