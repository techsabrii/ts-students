<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentNotReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $course;
    public $month;

    public function __construct(User $user, Course $course , $month)
    {
        $this->user = $user;
        $this->course = $course;
        $this->month = $month;
    }

    public function build()
    {
        return $this->view('emails.payment_not_received')
                    ->subject('Payment Not Received')
                    ->with([
                        'userName' => $this->user->student_name,
                        'courseName' => $this->course->course_name,
                        'month' => $this->course->month,
                    ]);
    }
}
