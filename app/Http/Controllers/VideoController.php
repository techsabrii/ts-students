<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Course;
use App\Models\LanguageIcon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoController extends Controller
{
    // Display the video upload form
    public function create(Request $request)
    {
         if (!$this->isLoggedInAndHasRole('admin')) {
            // If not an admin, redirect to the home page with an error message
            return redirect()->route('user-profile')->with('error', 'Unauthorized access');
        }
        $courseNames = Course::pluck('course_name')->unique();
        $courseLanguages = Course::all()->mapWithKeys(function ($course) {
            return [$course->course_name => json_decode($course->language, true)];
        });

        // Check structure here

        return view('admin.uploads.video_upload', compact('courseNames', 'courseLanguages'));
    }

    private function isLoggedInAndHasRole($role)
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Get the logged-in user
            $user = Auth::user();

            // Check if the user's role matches the given role
            return $user->role === $role; // Assuming 'role' is a string attribute on the User model
        }
        return false;
    }



    // Handle the video upload and store metadata in the database
    public function upload(Request $request)
    {
        // Validate the uploaded video files and description
        $validated = $request->validate([
            'video_original' => 'required|mimes:mp4,avi,mkv|max:2048000',
            'language' => 'required|string',
            'title' => 'nullable|string|max:255',
            'course_name' => 'nullable|string|max:255',
            'description' => 'required|string|max:5000',
        ]);

        try {
            // Store the original video in a public directory
            $videoOriginal = $request->file('video_original');
            $originalPath = $videoOriginal->storeAs('videos', time() . '_original_' . $videoOriginal->getClientOriginalName(), 'public');

            // Store video metadata in the database
            Video::create([
                'title' => $request->title,
                'original_video' => $originalPath,
                'course_name'=> $request->course_name,
                'language' => $request->language,
                'description' => $request->description,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Video uploaded successfully!',
                'path' => $originalPath,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed. Please try again.',
                'error' => $e->getMessage(), // Return error message for debugging
            ], 500);
        }
    }


    public function show(Request $request)
    {
        // Fetch the currently authenticated user
        $user = Auth::user();

        // Redirect to login page if the user is not logged in
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view the video.');
        }

        // Check if the user's registration status is not 1 (approved)
        if ($user->reg_status !== 1) {
            return redirect()->route('registrationcheck')->withErrors('Your registration is pending. Kindly register yourself.');
        }

        // Get the selected language and course from the request
        $selectedLanguage = $request->input('language');
        $selectedCourse = $request->input('course_name');

        // If the selected language is not 'NewsFeed' and stealth mode is not enabled, redirect
        if ($selectedLanguage !== 'NewsFeed' && $user->stealth_mode !== 1) {
            return redirect()->route('courses.index')->withErrors('Your fee is not submitted. Kindly submit your fee for this month.');
        }

        // Get all unique languages and courses for filtering
        $languages = Video::pluck('language')->unique();
        $courses = Video::pluck('course_name')->unique();

        // Fetch videos based on the selected filters and order by creation date (latest first)
        $videosQuery = Video::query();

        if ($selectedLanguage) {
            $videosQuery->where('language', $selectedLanguage);
        }

        if ($selectedCourse) {
            $videosQuery->where('course_name', $selectedCourse);
        }

        // Order by latest on top
        $videos = $videosQuery->orderBy('created_at', 'desc')->get();

        // Handle case where no videos are found
        if ($videos->isEmpty()) {
            return back()->withErrors('No videos found for the selected filters.');
        }

        // Get the current video index from the URL parameter (defaults to 0 if not set)
        $currentVideoIndex = $request->input('video', 0);

        // Get the current video data based on the index
        $currentVideo = $videos[$currentVideoIndex];

        // Determine the next video index (loop back to 0 if at the end)
        $nextVideoIndex = ($currentVideoIndex + 1) % count($videos);

        // Construct the URL for the video stored in the public storage folder
        $videoUrl = asset('storage/' . $currentVideo->original_video);

        return view('admin.uploads.show', [
            'videos' => $videos,
            'currentVideo' => $currentVideo,
            'currentVideoIndex' => $currentVideoIndex,
            'nextVideoIndex' => $nextVideoIndex,
            'videoUrl' => $videoUrl,
            'languages' => $languages,
            'courses' => $courses,
            'selectedLanguage' => $selectedLanguage,
            'selectedCourse' => $selectedCourse,
        ]);
    }



// lectures page


// Controller: LectureController.php

public function showLectures(Request $request)
    {
        // Fetch the currently authenticated user
        $user = Auth::user();

        // Fetch the courses the user is registered for
        $userCourses = $user->courses;

        // Get all available languages and icons
        $languages = Video::pluck('language')->unique();  // Get all distinct languages
        $languageIcons = LanguageIcon::all()->pluck('icon_path', 'language_name'); // Fetch language icons

        // Get the selected course and language from the request
        $selectedCourse = $request->input('course_name');
        $selectedLanguage = $request->input('language');

        // Group languages by course, and filter by selected course and language if provided
        $groupedLanguages = $userCourses->when($selectedCourse, function ($query) use ($selectedCourse) {
            return $query->filter(function ($course) use ($selectedCourse) {
                return $course->course_name === $selectedCourse;
            });
        })->mapWithKeys(function ($course) use ($selectedLanguage) {
            $languages = Video::where('course_name', $course->course_name)
                              ->pluck('language')
                              ->unique()
                              ->filter(function ($language) use ($selectedLanguage) {
                                  return ($selectedLanguage) ? $language === $selectedLanguage : true;
                              });
            return [$course->course_name => $languages];
        });

        return view('user.lecture', compact('userCourses', 'groupedLanguages', 'selectedCourse', 'languageIcons', 'languages', 'selectedLanguage'));
    }



}
