<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Method to fetch courses for the logged-in user
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch courses for the logged-in user
        // Assuming the user has a relationship with the Course model (you can change this to suit your needs)
        $courses = Course::where('user_id', $user->id)->get();

        // Assuming the fees are stored as JSON in the 'fees' column, you pass this data to the view
        return view('user.fee.fee', compact('courses'));
    }


    public function getCoursesByUser(Request $request)
    {
        // Fetch the currently authenticated user
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your courses.');
        }

        // Fetch courses where the user_id matches the logged-in user's ID
        $courses = Course::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        if ($courses->isEmpty()) {
            return view('user.courses', ['courses' => $courses])->with('error', 'You have no Course Registration.');
        }

        return view('user.courses', [
            'courses' => $courses,
        ]);
    }


 public function getUserCoursesBy(Request $request)
    {
        // Fetch the currently authenticated user
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your courses.');
        }

        // Fetch courses where the user_id matches the logged-in user's ID
        $courses = Course::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        if ($courses->isEmpty()) {
            return view('user.courses', ['courses' => $courses])->with('error', 'You have no Course Registration.');
        }

        return view('user.user-profile', [
            'courses' => $courses,
        ]);
    }







}
