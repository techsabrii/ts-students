<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Mail\FeeReminderMail;
use App\Mail\PaymentReceived;
use App\Mail\PaymentNotReceived;
use App\Models\TransactionRecord;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
// Make sure to import Auth

class TransactionRecordController extends Controller
{
    /**
     * Store the transaction record.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'month' => 'required|string|max:255',
            'tr_id' => 'required|string|max:255',
            'receipt' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048', // Validate the receipt file
        ]);

        // Get the authenticated user's ID
        $user_id = Auth::id();  // Get the user ID from Auth

        // Handle the file upload for the receipt
        if ($request->hasFile('receipt') && $request->file('receipt')->isValid()) {
            // Store the receipt in the 'public' directory
            $receiptPath = $request->file('receipt')->store('receipts', 'public');

            // Create the new transaction record in the database
            $transactionRecord = TransactionRecord::create([
                'user_id' => $user_id,  // Use the authenticated user's ID
                'course_name' => $validated['course_name'],
                'month' => $validated['month'],
                'tr_id' => $validated['tr_id'],
                'receipt_url' => $receiptPath, // Store the receipt's URL
                'status' => 'pending',  // Default status is 'pending'
            ]);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Transaction record added successfully!');
        }

        // If file upload failed
        return redirect()->back()->with('error', 'File upload failed.');
    }



// admin functions


            public function index(Request $request)
            {
                
                
                if (!$this->isLoggedInAndHasRole('admin')) {
            // If not an admin, redirect to the home page with an error message
            return redirect()->route('user-profile')->with('error', 'Unauthorized access');
        }

                // Get the month and course_name from the request (if any)
                $month = $request->get('month');
                $tr_id = $request->get('tr_id');
                $courseName = $request->get('course_name');
                $status = $request->get('status');

                // Start with the base query to fetch records with the related user data
                $query = TransactionRecord::with('user');

                // Filter by month if provided

                if ($tr_id) {
                    $query->where('tr_id', $tr_id);
                }
                if ($month) {
                    $query->where('month', $month);
                }

                // Filter by course_name if provided
                if ($courseName) {
                    $query->where('course_name', $courseName);
                }

                if ($status) {
                    $query->where('status', $status);
                }

                // Order the records by created_at in descending order (latest records first)
                $transactionRecords = $query->orderBy('created_at', 'desc')->get();

                // Return the view with the filtered transaction records
                return view('admin.fee_controls.fee_status', compact('transactionRecords'));
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
    
    
            public function updateTransactionStatus(Request $request)
            {
                // Validate the input
                $validated = $request->validate([
                    'transaction_id' => 'required|exists:transactions_record,id',
                    'status' => 'required|string',
                    'month' => 'required|string',  // Month will be passed in as 'month 1', 'month 2', etc.
                    'course_name' => 'required|string',
                ]);

                // Find the transaction record
                $transaction = TransactionRecord::find($validated['transaction_id']);

                if (!$transaction) {
                    return redirect()->back()->withErrors('Transaction not found.');
                }

                // Check if the transaction belongs to the correct user and course
                $month = $validated['month'];

                $user = $transaction->user;
                $course = Course::where('user_id', $user->id)
                                ->where('course_name', $validated['course_name'])
                                ->first();

                if (!$course) {
                    return redirect()->back()->withErrors('Course not found for the given user.');
                }

                // Update the transaction status
                $transaction->status = $validated['status'];
                $transaction->save();

                // Update the 'fees' array in the Course model
                $fees = json_decode($course->fees, true) ?: [];

                // Check if the month exists in the fees
                $monthKey = 'month ' . $validated['month']; // e.g., 'month 1'

                if (isset($fees[$monthKey])) {
                    // Update the status for the selected month
                    $fees[$monthKey]['status'] = $validated['status'];
                } else {
                    return redirect()->back()->withErrors('Month data not found in the fees.');
                }

                // Save the updated fees back to the course
                $course->fees = json_encode($fees);
                $course->save();

                // Check if the status is "paid"
                if ($validated['status'] == 'Paid') {
                    // Update the stealth_mode to 1 in the user table
                    $user->stealth_mode = 1;
                    $user->save();  // Save the updated stealth_mode

                    // Send email notification for payment received
                    Mail::to($user->email)->send(new PaymentReceived($user, $course, $month));

                    return redirect()->back()->with('success', 'Payment received, stealth mode updated, and email sent.');
                } else {
                    // Send email notification for payment not received
                    Mail::to($user->email)->send(new PaymentNotReceived($user, $course, $month));

                    return redirect()->back()->with('success', 'Payment not received, email sent.');
                }
            }






                // Update stealth mode and send fee reminder email
                public function updateStatus(Request $request, $userId)
                {
                    try {
                        // Find the user by ID
                        $user = User::findOrFail($userId);

                        // Store the current stealth_mode value before any updates
                        $currentStealthMode = $user->stealth_mode;

                        // Update the stealth_mode value
                        $user->stealth_mode = $request->stealth_mode;
                        $user->save();

                        // Get course and month from request
                        $course = $request->course_name;
                        $month = $request->month;

                        // Send email if stealth_mode is 1 (Active)
                        if ($request->stealth_mode == 1) {
                            // Send the email to the user when stealth_mode is set to Active
                            Mail::to($user->email)->send(new FeeReminderMail($user, $course, $month));
                            Log::info('Email sent to: ' . $user->email . ' because stealth mode is set to Active.');
                        }

                        // Return success
                        return redirect()->back()->with('success', 'Status updated successfully!');
                    } catch (\Exception $e) {
                        // Log the error in case the mail sending fails
                        Log::error('Error sending email: ' . $e->getMessage());
                        return redirect()->back()->with('error', 'Error sending email.');
                    }
                }







                public function record(Request $request)
                {
                             
                if (!$this->isLoggedInAndHasRole('admin')) {
            // If not an admin, redirect to the home page with an error message
            return redirect()->route('user-profile')->with('error', 'Unauthorized access');
        }
                    
                    // Fetch the filters from the request
                    $course_name = $request->input('course_name');
                    $month = $request->input('month');
                    $status = $request->input('status');

                    // Query the Course model with filters
                    $courses = Course::query();

                    // Apply the course_name filter if selected
                    if ($course_name) {
                        $courses->where('course_name', 'like', '%' . $course_name . '%');
                    }

                    // Apply the month filter if selected
                    if ($month) {
                        // Filter by month
                        $courses->whereJsonContains('fees->' . $month . '->month', $month);
                    }

                    // Apply the status filter if selected
                    if ($status) {
                        // Filter by status within the specific month
                        $courses->whereJsonContains('fees->' . $month . '->status', $status);
                    }

                    // Get the filtered courses with pagination
                    $courses = $courses->paginate(100);

                    // Return the view with the filtered courses
                    return view('admin.fee_controls.Check-fee-status', compact('courses'));
                }




}
