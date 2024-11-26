<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use App\Mail\ResetPasswordOtpMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{
    /**
     * Show OTP form to the user
     */
    public function showOtpForm()
    {
        return view('auth.otp.forget');
    }
    public function resetform()
    {
        return view('auth.reset');
    }

    /**
     * Send OTP to the email entered by the user
     */
    public function sendOtp(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email|exists:users,email', // Check if email exists in the users table
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        // Generate OTP (6-digit OTP)
        $otp = rand(100000, 999999);

        // Set OTP expiration time (e.g., 20 minutes from now)
        $expiresAt = Carbon::now()->addMinutes(20);

        // Save OTP and expiration time in the database for verification later
        $user->otp = $otp;
        $user->otp_expires_at = $expiresAt;
        $user->save();

        // Store the email in the session to verify OTP later
        session(['otp_email' => $request->email]);

        // Send the OTP email
        Mail::to($user->email)->send(new ResetPasswordOtpMail($otp, $expiresAt));

        // Return response indicating OTP was sent
        return redirect()->route('otp.form')->with('success', 'OTP sent to your email. Please check your inbox.');
    }

    /**
     * Verify OTP entered by the user
     */

    // Verify OTP entered by the user
    public function verifyOtp(Request $request)
    {
        // Validate OTP input
        $request->validate([
            'otp_combined' => 'required|numeric|digits:6', // Ensure OTP is 6 digits
        ]);

        // Get the email stored in the session
        $email = session('otp_email');

        // Check if the session has expired
        if (!$email) {
            return redirect()->route('login')->withErrors(['email' => 'Session expired, please request OTP again.']);
        }

        // Find the user by email
        $user = User::where('email', $email)->first();

        // If the user is not found
        if (!$user) {
            return back()->withErrors(['otp' => 'No user found with this email.']);
        }

        // Check if OTP is valid and not expired
        if ($user->otp === $request->otp_combined && Carbon::now()->lt($user->otp_expires_at)) {
            // OTP is valid, proceed with password reset

            // Send an email notifying the user that the OTP is verified
            // Clear OTP from the database (optional: for security reasons)
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            // Redirect to the reset form with the email included
            return redirect()->route('reset.form')->with('success', 'OTP verified. Please enter your new password.')->with('email', $user->email);
        }

        // If OTP is invalid or expired, show error message
        return back()->withErrors(['otp' => 'Invalid or expired OTP. Please try again.']);
    }




    /**
     * Show the form to reset the password
     */
    public function showResetPasswordForm()
    {
        return view('auth.passwords.reset');
    }

    /**
     * Update the password after OTP verification
     */


    public function restpassword(Request $request)
    {
        // Validate new password
        $request->validate([
            'password' => 'required|min:6|confirmed', // Password must be confirmed
        ]);

        // Get the email stored in the session
        $email = session('otp_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            // If user not found, session expired or other error
            return redirect()->route('login')->withErrors(['email' => 'Your session has expired. Please try again.']);
        }

        // Hash the new password using Laravel's Hash facade
        $newPassword = $request->password;  // The new password entered by the user
        $user->password = Hash::make($newPassword);  // Hash the new password using Hash::make()

        // Clear OTP and related data
        $user->otp = null;  // Clear OTP after password reset
        $user->otp_expires_at = null;  // Clear OTP expiration time
        $user->is_verified = true;  // Mark user as verified or password reset completed
        $user->save();  // Save the updated user data

        // Send the new password to the user via email (optional)
        // It's not common to send the plain-text password in email. Typically, you'd send a "Password Reset Successful" message or a link to re-login.
        Mail::to($user->email)->send(new PasswordResetMail($newPassword, $user->email));

        // Clear OTP session data
        session()->forget('otp_email');

        // Redirect user back to login page with success message
        return redirect()->route('login')->with('success', 'Your password has been reset successfully and sent to your email.');
    }

}
