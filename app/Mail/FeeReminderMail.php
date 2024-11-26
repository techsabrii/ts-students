<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Queue\SerializesModels;

class FeeReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $course;
    public $month;

    // Constructor accepts user, course, and month
    public function __construct(User $user, $course, $month)
    {
        $this->user = $user;
        $this->course = $course;
        $this->month = $month;
    }

    public function build()
    {
        return $this->subject('Fee Reminder')
                    ->view('emails.fee_reminder') // Email view path
                    ->with([
                        'userName' => $this->user->student_name,
                        'courseName' => $this->course,
                        'month' => $this->month
                    ]);
    }
}
