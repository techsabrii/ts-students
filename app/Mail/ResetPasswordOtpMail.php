<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;  // OTP code that will be sent
    public $expiresAt; // Expiry time of OTP

    /**
     * Create a new message instance.
     *
     * @param  string  $otp
     * @param  \Carbon\Carbon  $expiresAt
     * @return void
     */
    public function __construct($otp, $expiresAt)
    {
        $this->otp = $otp;
        $this->expiresAt = $expiresAt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your OTP for Password Reset')  // Subject of the email
                    ->view('emails.resetotp') // View to render the email content
                    ->with([
                        'otp' => $this->otp,
                        'expiresAt' => $this->expiresAt->toFormattedDateString(), // Format the expiry date
                    ]);
    }
}
