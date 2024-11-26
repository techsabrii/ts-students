<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{
    public function index()
    {
        $students = User::all(); // Fetch all users
        return view('emails.announcement', compact('students'));
    }


    public function sendEmails(Request $request)
    {
        $validated = $request->validate([
            'students' => 'required|array', // Ensure students array is provided
            'message' => 'required|string', // Message content
        ]);

        $students = User::whereIn('id', $validated['students'])->get();
        $message = $validated['message'];

        foreach ($students as $student) {
            Mail::raw($message, function ($mail) use ($student) {
                $mail->to($student->email)
                     ->subject('Important Announcement');
            });
        }

        return redirect()->back()->with('success', 'Emails sent successfully!');
    }
}
