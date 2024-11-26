<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */


    /**
     * Display the profile update form.
     */
    public function show()
    {
        return view('profile.update');
    }

    /**
     * Handle the profile update form submission.
     */
    public function updatee(Request $request)
    {
        // Validate the incoming request data
        $request->validate([

            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'nic' => 'required|string|max:16',
            'gender' => 'required|string|max:16',
            'postal_address' => 'required|string|max:255',
            'home_address' => 'required|string|max:255',
            'decs' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'github' => 'required|url|max:255',
            'contact' => 'required|string|max:255',
              // Password is optional but must be confirmed if provided
        ]);

        // Get the authenticated user
        $user = Auth::user();
        $user = User::updateOrCreate(
            ['id' => $user->id],
            $request->only([
            'student_name' ,
            'father_name' ,
            'date_of_birth',
            'nic',
            'gender' ,
            'postal_address' ,
            'home_address',
            'decs' ,
            'education',
            'subject' ,
            'github'  ,
            'contact' ,
            ])
        );

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


public function updateUserPhoto(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048', // Example validation for image file
    ]);

    // Check if the image is present
    if ($request->hasFile('image')) {
        // Get the image file
        $image = $request->file('image');

        // Store the image and get the path
        $path = $image->store('images', 'public'); // Store in the 'images' folder under 'public' disk

        // Get the authenticated user
        $user = Auth::user();

        // Use updateOrCreate to update the user's image_path or create if not found
        $user = User::updateOrCreate(
            ['id' => $user->id], // Where clause to find the user
            ['image_path' => $path] // Data to update or create
        );

        // Return back with success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    // In case no image was uploaded
    return redirect()->back()->with('error', 'No image uploaded.');
}

}
