<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationCompleteMail;



class RegistrationController extends Controller
{
    // Store Registration Data
    public function storeRegistration(Request $request)
    {
        // Validate the data (adjust validation rules as needed)
        $request->validate([
            'tr_id' => 'required|string',
            'receipt' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Handle file upload
        $receiptPath = $request->file('receipt')->store('receipts', 'public');

        // Get the authenticated user's ID
        $user_id = Auth::id(); // Get the authenticated user's ID directly

        // Store the data in the 'registrations' table
        $registration = Registration::create([
            'user_id' => $user_id,   // Automatically use the authenticated user's ID
            'tr_id' => $request->tr_id,
            'fee' => '1000', // Transaction ID
            'receipt' => $receiptPath,  // File path for receipt
        ]);

        // Update the registration status in the 'users' table as well


        return redirect()->route('registrationcheck')->with([
            'success' => 'Registration is complete now wait for status changing  ',
            'registration' => $registration
        ]);
    }


    // Check the Registration Status and Pass It to the View
    public function checkRegistrationStatus()
    {
        // Use the auth() helper to get the currently authenticated user
        $user = Auth::user();  // This gets the currently logged-in user

        // Check if user is authenticated
        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'message' => 'User is not logged in.'
            ]);
        }

        // Check the user's reg_status to determine if registration is complete
        $status = $user->reg_status;  // Retrieve the 'reg_status' field

        // Set registration status message based on 'reg_status'
        $registrationStatus = '';
        if ($status == '1') {
            $registrationStatus = 'Complete';
        } else {
            $registrationStatus = 'Pending';
        }

        // Pass the registration status to the view
        return view('user.fee.register_student', ['registrationStatus' => $registrationStatus]);
    }







// for admin functions


// In your controller method
public function index(Request $request)
    {
        // Check if the user is logged in and has 'admin' role
        if (!$this->isLoggedInAndHasRole('admin')) {
            // If not an admin, redirect to the home page with an error message
            return redirect()->route('user-profile')->with('error', 'Unauthorized access');
        }

        // Get the filter 'tr_id' from the request if exists
        $tr_id = $request->input('tr_id'); // This would be the search filter for transaction ID

        // Fetch all users with their registration data, ordered by 'created_at'
        // If 'tr_id' is provided, filter the users based on the transaction ID
        $users = User::with('registration')
            ->when($tr_id, function($query) use ($tr_id) {
                // Filter by 'tr_id' if provided
                return $query->whereHas('registration', function($query) use ($tr_id) {
                    $query->where('tr_id', 'like', "%$tr_id%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the view with filtered users and their registration data
        return view('admin.fee_controls.reg_approval', compact('users'));
    }

    // Custom helper function to check login status and role
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


public function register(User $user)
    {
        // Check if the user already has a registration record
        $registration = Registration::where('user_id', $user->id)->first();

        if ($registration) {
            // Update the registration status in the user table
            $user->reg_status = '1';  // Change the reg_status to 'completed'
            $user->save();  // Save the user's updated status

            // Send an email to the user notifying them that their registration is complete
            Mail::to($user->email)->send(new RegistrationCompleteMail($user));

            // Redirect back with a success message
            return redirect()->back()->with('success', 'User has been successfully registered and notified.');
        } else {
            // If no registration found for the user
            return redirect()->back()->with('error', 'No registration record found for this user.');
        }
    }






















}




