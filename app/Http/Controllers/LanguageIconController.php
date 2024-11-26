<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Course;

use Illuminate\Support\Facades\Auth;
use App\Models\LanguageIcon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;


class LanguageIconController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->isLoggedInAndHasRole('admin')) {
            // If not an admin, redirect to the home page with an error message
            return redirect()->route('user-profile')->with('error', 'Unauthorized access');
        }

        // Fetch all language icons
        $languageIcons = LanguageIcon::all();

        // Fetch languages from the `course` table, decode JSON, merge, and get unique values
        $languages = Course::pluck('language') // Fetch the `language` column from all records
            ->flatMap(function ($item) {
                return json_decode($item, true) ?: []; // Decode JSON and ensure it's an array
            })
            ->unique() // Remove duplicate entries
            ->sort()   // Sort languages alphabetically
            ->values(); // Reindex the collection for proper output

        // Pass data to the view
        return view('icons.index', compact('languages', 'languageIcons'));
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


public function create()
{
    // Fetch all courses
    $courses = Course::all();

    // Extract all languages from the courses and flatten them into a single array
    $languages = $courses->pluck('language')->flatten()->unique();

    // Fetch all language icons (if needed in the view)
    $languageIcons = LanguageIcon::all();

    // Return the 'icons.index' view with the languages and languageIcons
    return view('icons.index', compact('languages', 'languageIcons'));
}




public function store(Request $request)
{
    $request->validate([
        'language_name' => 'required|max:255',
        'icon' => 'required|image|mimes:png,jpg,jpeg|max:2048',
    ]);

    $icon = LanguageIcon::where('language_name', strtolower($request->language_name))->first();

    if ($icon) {
        if (Storage::exists($icon->icon_path)) {
            Storage::delete($icon->icon_path);
        }

        $iconPath = $request->file('icon')->store('language_icons', 'public');
        $icon->update([
            'icon_path' => $iconPath,
        ]);

        $message = 'Language icon updated successfully!';
    } else {
        $iconPath = $request->file('icon')->store('language_icons', 'public');

        LanguageIcon::create([
            'language_name' => strtolower($request->language_name),
            'icon_path' => $iconPath,
        ]);

        $message = 'Language icon uploaded successfully!';
    }

    return redirect()->route('icons.create')->with('success', $message);
}


    public function destroy($id)
    {
        $icon = LanguageIcon::findOrFail($id);

        // Check if the icon file exists in storage
        $iconPath = $icon->icon_path;

        if ($iconPath && Storage::exists($iconPath)) {
            // File exists, so delete it
            Storage::delete($iconPath);
        } else {
            // Handle case where file doesn't exist
            return back()->with('error', 'File not found.');
        }

        // Delete the record from the database
        $icon->delete();

        return back()->with('success', 'Icon deleted successfully.');
    }
}
