<?php
namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');  // Show login form
    }

   public function login(Request $request)
{
    // Validate login credentials
    $credentials = $request->only('email', 'password');

    // Attempt to authenticate the user
    if (Auth::attempt($credentials)) {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is verified
        if ($user->is_verified) {
            // Check if the user has an admin role or a user role
            if ($user->role === 'admin') {
                // If admin, redirect to the admin dashboard
                return redirect()->route('video.create');
            } elseif ($user->role === 'user') {
                // If user, redirect to the homepage
                return redirect()->intended('profile');
            }
        } else {
            // If not verified, generate OTP and send it
            $this->generateOtp($user);

            // Send the OTP to the user's email
            Mail::to($user->email)->send(new OtpMail($user->otp));

            // Store email in the session to retrieve later during OTP verification
            session(['otp_email' => $user->email]);

            // Log the user out to prevent access until OTP verification
            Auth::logout();

            // Redirect the user to the OTP verification page
            return redirect()->route('verify');
        }
    }

    // If authentication fails, show an error
    return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
}


    // Generate OTP and store it in the database
    protected function generateOtp(User $user)
    {
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);  // Generate a random 6-character OTP
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(20);  // Set expiration time (5 minutes)
        $user->save();  // Save OTP and expiration time to the database
    }

    // OTP verification logic
    public function verifyOtp(Request $request)
    {
        // Validate the combined OTP string
        $request->validate([
            'otp_combined' => 'required|numeric|digits:6', // OTP should be 6 digits
        ]);

        // Retrieve the user's email from the session
        $email = session('otp_email');

        if (!$email) {
            return back()->withErrors(['otp' => 'Session expired. Please try logging in again.']);
        }

        // Find the user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'User not found.']);
        }

        // Retrieve the entered OTP from the request
        $enteredOtp = $request->otp_combined;

        // Check if the entered OTP is valid and not expired
        if ($user->isValidOtp($enteredOtp)) {
            // Mark OTP as used and verify the user
            $this->markOtpAsUsed($user);

            // Log the user in and redirect to the intended page
            Auth::login($user);

            // Clear OTP session data
            session()->forget('otp_email');

            return redirect()->intended('video');
        }

        // If OTP is invalid or expired, show an error
        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }


    // Mark OTP as used and verify the user
    protected function markOtpAsUsed(User $user)
    {
        // Mark OTP as used by clearing it and clearing the expiration time
        $user->otp = null;
        $user->otp_expires_at = null;

        // Mark the user as verified
        $user->is_verified = true;  // Ensure that the user is marked as verified

        // Set the email_verified_at timestamp to the current time
        $user->email_verified_at = now();  // Set the current timestamp

        // Save changes to the database
        $user->save();
    }


    // Log out the user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }







    public function changePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the old password matches the stored password
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        // Update the password in the database
        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Log the user out from all devices by invalidating the session
        Auth::logoutOtherDevices($request->new_password);

        // Optionally, if you want to manually clear the session
        Session::invalidate();
        Session::regenerateToken();

        // Redirect back with success message
        return back()->with('success', 'Password updated successfully. You have been logged out from all devices.');
    }



    public function showLoginDevices()
    {
        $user = Auth::user();

        // Fetch all sessions for the authenticated user from the sessions table
        $sessions = DB::table('sessions')
            ->where('user_id', $user->id)
            ->get();

        // Prepare array to store session data with location information
        $sessionsWithLocation = [];

        foreach ($sessions as $session) {
            // Use IP address to get location (optional: use a free API like ipstack or ipinfo.io)
            $location = $this->getLocationFromIp($session->ip_address);

            // Check if last_activity exists and format it
            $lastActivity = isset($session->last_activity)
                ? Carbon::createFromTimestamp($session->last_activity)->format('Y-m-d H:i:s')
                : 'N/A';

            $sessionsWithLocation[] = [
                'user_agent' => $session->user_agent,
                'ip_address' => $session->ip_address,
                'location' => $location,
                'last_activity' => $lastActivity,  // Use last_activity
            ];
        }

        return view('user.settings', compact('sessionsWithLocation'));
    }


    private function getLocationFromIp($ipAddress)
    {
        // Use a free IP geolocation service like ipinfo.io or ipstack.com
        $client = new Client();
        $response = $client->get("http://ipinfo.io/{$ipAddress}/json");

        // Convert the JSON response to an array
        $data = json_decode($response->getBody()->getContents(), true);

        // Return the location information (e.g., city, region, country)
        return isset($data['city']) ? $data['city'] . ', ' . $data['region'] . ', ' . $data['country'] : 'Unknown Location';
    }




public function logoutFromAllDevices()
{
    $user = Auth::user();
    $sessionId = Session::getId(); // Get current session ID

    // Log out the user from all devices except the current one
    Session::where('user_id', $user->id)->where('session_id', '!=', $sessionId)->delete();

    // Optionally logout the user from the current device too
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();

    return redirect()->route('login')->with('success', 'You have been logged out from all devices.');
}


}
