<?php

// app/Mail/RegistrationCompleteMail.php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationCompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    // Constructor
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Build the email
    public function build()
    {
        return $this->view('emails.registration_complete')  // The view for the email
                    ->with([
                        'userName' => $this->user->student_name,
                        'userEmail' => $this->user->email,
                    ]);
    }
}
