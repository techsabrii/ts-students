<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Auth;




class StudentController extends Controller
{
    /**
     * Register a new student and store their course fees as a JSON array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     public function register(Request $request)
     {


         // Validate the basic student data
         $validator = Validator::make($request->all(), [
             'email' => 'required|string|email|max:255|unique:users,email',
             'student_name' => 'required|string|max:255',
             'father_name' => 'required|string|max:255',
             'nic' => 'required|unique:users,nic',
             'date_of_birth' => 'required|date',
             'home_address'=> 'required',
             'contact'=> 'required|string',
             'education'=> 'required',
             'subject'=> 'required',
             'decs'=> 'required',
             'course_name' => 'required|string|max:255',

           // Validate image file, optional
         ]);

         // If validation fails, return errors
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 422);
         }

         // Generate a random password
         $randomPassword = Str::random(12); // 12 characters random password

         // Hash the password
         $hashedPassword = Hash::make($randomPassword);



         // Generate random slug based on student name
 $slug = Str::slug($request->student_name . rand(1000, 9999));

         // Store user data in the users table
         $user = User::create([
             'name' => $slug, // Store generated slug in the 'name' field
             'email' => $request->email,
             'password' => $hashedPassword, // Store hashed password
             'student_name' => $request->student_name,
             'father_name' => $request->father_name,
             'date_of_birth' => $request->date_of_birth,
             'contact' => $request->contact,
             'home_address'=> $request->home_address,
             'nic' => $request->nic,
             'education'=>$request->education,
             'subject' => $request->subject,
             'decs' => $request->decs,

              // Store the uploaded result image path
         ]);

         // Define the fee structure and languages based on course name
         $fees = [];
         $languages = [];
         $details = '';
         $duration = '';

         if ($request->course_name === "Web Development with Laravel") {
             $fees = [
                 'month 1' => ['amount' => '2500', 'status' => 'pending', 'submit_date' => null],
                 'month 2' => ['amount' => '2500', 'status' => 'pending', 'submit_date' => null],
                 'month 3' => ['amount' => '2500', 'status' => 'pending', 'submit_date' => null],
                 'month 4' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
                 'month 5' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
                 'month 6' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
                 'month 7' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
             ];

             // Languages for Web Development with Laravel
             $languages = [
                 'Newsfeed','HTML', 'CSS', 'Bootstrap', 'JavaScript', 'JQuery', 'Ajax', 'PHP', 'PHP-OOP', 'MySQL', 'Laravel'
             ];
             $details = '<html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Web Development Course Details</title> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> <style> body { font-family: Arial, sans-serif; background-color: #f8f9fa; color: #333; padding: 20px; } .course-header { background-color: #007bff; color: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; } .course-header h1 { margin: 0; font-size: 2.5rem; } .course-section { margin-bottom: 20px; } .tech-list li { margin-bottom: 10px; } .cta-button { background-color: #007bff; color: #fff; padding: 10px 15px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 20px; font-weight: bold; } .cta-button:hover { background-color: #0056b3; text-decoration: none; } </style> </head> <body> <div class="course-header"> <h1>Web Development Course</h1> <p>Master the fundamentals of modern web development with hands-on experience.</p> </div> <div class="course-section"> <h2>Course Overview</h2> <p> This comprehensive course is designed to equip you with the skills and knowledge needed to create dynamic, responsive, and user-friendly websites. Whether youre a beginner or looking to enhance your skills, this course covers all the essential tools and technologies required to excel in web development. </p> </div> <div class="course-section"> <h2>Technologies You Will Learn</h2> <ul class="tech-list"> <li><strong>HTML:</strong> Learn the structure of web pages and the foundation of web development.</li> <li><strong>CSS:</strong> Style your web pages with modern layouts, animations, and responsive design.</li> <li><strong>Bootstrap:</strong> Build professional-grade, responsive websites quickly using the Bootstrap framework.</li> <li><strong>JavaScript:</strong> Add interactivity and dynamic content to your websites.</li> <li><strong>jQuery:</strong> Simplify JavaScript tasks with this powerful library.</li> <li><strong>Ajax:</strong> Create seamless, real-time data interactions without reloading the page.</li> <li><strong>PHP:</strong> Learn server-side scripting to build dynamic web applications.</li> <li><strong>PHP-OOP:</strong> Master Object-Oriented Programming in PHP for scalable and reusable code.</li> <li><strong>MySQL:</strong> Design and manage robust databases to store your application data.</li> <li><strong>Laravel:</strong> Use the powerful Laravel framework to create scalable and maintainable web applications.</li> </ul> </div> <div class="course-section"> <h2>Course Highlights</h2> <ul> <li>Real-world projects to build a portfolio.</li> <li>Hands-on coding exercises and practical examples.</li> <li>Step-by-step guidance from industry experts.</li> <li>Modern tools and technologies covered in-depth.</li> <li>Focus on best practices and performance optimization.</li> </ul> </div> <div class="course-section"> <h2>Who Should Take This Course?</h2> <p> This course is ideal for: <ul> <li>Beginners looking to start a career in web development.</li> <li>Students and professionals wanting to upgrade their technical skills.</li> <li>Entrepreneurs who want to build and manage their own websites.</li> <li>Anyone with a passion for technology and web development.</li> </ul> </p> </div> <a href="#" class="cta-button">Enroll Now</a> </body> </html>';
             $duration = '7';

         } elseif ($request->course_name === "App Development with Flutter") {
             $fees = [
                 'month 1' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
                 'month 2' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
                 'month 3' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
                 'month 4' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
                 'month 5' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
                 'month 6' => ['amount' => '4500', 'status' => 'pending', 'submit_date' => null],
             ];

             // Languages for Flutter
             $languages = [
                'Newsfeed', 'Dart', 'Firebase', 'Laravel', 'Pusher', 'Flutter'
             ];
             $details = '';
             $duration = '6';

         } else {
             // Handle raw fee data
             $feeData = $request->input('fees_data'); // Raw fee data string
             $feeLines = explode("\n", $feeData);

             foreach ($feeLines as $line) {
                 if (preg_match("/'(\d+)' = '(\d+)' status = '(.*?)'/", $line, $matches)) {
                     $fees[] = [
                         'fee_id' => $matches[1],
                         'amount' => $matches[2],
                         'status' => $matches[3],
                         'submit_at' => $matches[4], // Fee submission date
                     ];
                 }
             }
         }

         // Store course data in the courses table
         $course = Course::create([
             'user_id' => $user->id,
             'course_name' => $request->course_name,
             'duration' => $duration,
             'language' => json_encode($languages), // Store languages as a JSON-encoded string
             'details' => $details,
             'fees' => json_encode($fees), // Ensure the fees are stored as JSON-encoded string
         ]);

         // Send the random password via email
         $signInLink = route('login');
         Mail::to($user->email)->send(new WelcomeEmail($randomPassword, $signInLink));

         // Return success response
       return redirect('https://students.techsabrii.com/registration')
            ->with('success', 'Student and course registered successfully!')
            ->with('response', [
                'message' => 'Student and course registered successfully!',
                'user' => $user,
                'course' => $course
            ]);
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




public function fetchDataView()
{
      if (!$this->isLoggedInAndHasRole('admin')) {
            // If not an admin, redirect to the home page with an error message
            return redirect()->route('user-profile')->with('error', 'Unauthorized access');
        }

    try {
        // Fetch data from the external API
        $response = Http::get('https://techsabrii.com/api/get-data');

        // Check if the response was successful
        if ($response->successful()) {
            $responseData = $response->json(); // Decode JSON response into an array

            // Extract 'data' from the response
            $data = $responseData['data'] ?? []; // Use empty array if 'data' is not present

            // Pass the data to the view
            return view('registration', ['records' => $data]);
        }

        // Handle failed responses (e.g., status codes other than 200)
        return view('registration', ['error' => 'Failed to fetch data from the API.']);
    } catch (\Exception $e) {
        // Handle exceptions (e.g., network issues, API failure)
        return view('registration', ['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}


    }



























