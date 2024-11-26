<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\LanguageIconController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TransactionRecordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\Course;

Route::get('login', function () {
    return view('auth.login');
});



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::post('otp/verify/submit', [LoginController::class, 'verifyOtp'])->name('otp.verify.submit');

Route::get('verify', function () {return view('auth.otp.login'); })->name('verify');
Route::get('forget', function () {return view('auth.forget'); })->name('email.verify');



Route::post('otp/send', [ForgotPasswordController::class, 'sendOtp'])->name('otp.send');
Route::get('otp/form', [ForgotPasswordController::class, 'showOtpForm'])->name('otp.form');
Route::get('otp/verify', [ForgotPasswordController::class, 'showVerifyForm'])->name('otp.verify');
Route::post('otp/verify', [ForgotPasswordController::class, 'verifyOtp'])->name('otp.verify.reset.submit');
Route::get('reset', [ForgotPasswordController::class, 'resetform'])->name('reset.form');
Route::post('reset/password', [ForgotPasswordController::class, 'restpassword'])->name('password.update');
Route::post('/password/change', [LoginController::class, 'changePassword'])->name('password.change');

Route::middleware(['auth'])->group(function () {

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/logout-all', [LoginController::class, 'logoutFromAllDevices'])->name('logout.all');
    Route::get('setting', [LoginController::class, 'showLoginDevices'])->name('settings');


    Route::get('doc', function () {
        return view('user.doc');
    });
    Route::get('code', function () {
        return view('user.editor');
    });

    Route::get('/profile', [CourseController::class, 'getUserCoursesBy'])->name('user-profile');

Route::post('/profile/update', [ProfileController::class, 'updatee'])->name('update-profile');
Route::get('/update', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/user/update-photo', [ProfileController::class, 'updateUserPhoto'])->name('user.updatePhoto');


// fee upload start

Route::get('/fee', [CourseController::class, 'index'])->name('courses.index');
Route::post('/transaction-records', [TransactionRecordController::class, 'store'])->name('transaction-records.store');
// admin routes
Route::get('/fee-status-check', [TransactionRecordController::class, 'record'])->name('fee.index');
Route::get('/fee_approvel', [TransactionRecordController::class, 'index'])->name('transactions.index');
Route::post('/transaction/update-status', [TransactionRecordController::class, 'updateTransactionStatus'])->name('updateTransactionStatus');
Route::put('/users/{user}/update-status', [TransactionRecordController::class, 'updateStatus'])->name('user.updateStatus');

//  registration fee upload start
Route::post('/register', [StudentController::class, 'register'])->name('students.register.admin');
Route::get('/reg-approvel', [RegistrationController::class, 'index'])->name(('registration.index'));
Route::get('/registration-status', [RegistrationController::class, 'checkRegistrationStatus'])->name(('registrationcheck'));
Route::post('/registration', [RegistrationController::class, 'storeRegistration'])->name(('storeRegistration'));
// admin

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/user/register/{user}', [RegistrationController::class, 'register'])->name('user.register');


// routes/web.php

Route::get('video/upload', [VideoController::class, 'create'])->name('video.create'); // Display the video upload form
    Route::post('video/upload1', [VideoController::class, 'upload'])->name('video.upload.store');

Route::get('/', [VideoController::class, 'show'])->name('video.show');
  // Show a specific video with description
Route::get('/video/progress', [VideoController::class, 'getProgress'])->name('video.getProgress');

// Show the annaunsment emails
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::post('/announcements/send', [AnnouncementController::class, 'sendEmails'])->name('announcements.send');


// lectures page
Route::get('lectures', [VideoController::class, 'showLectures'])->name('user.lectures');
Route::get('/video/watch/{hash}', [VideoController::class, 'watch'])->name('video.watch');




Route::get('/icons/create', [LanguageIconController::class, 'index'])->name('icons.create'); // Show the form
Route::post('/icons', [LanguageIconController::class, 'store'])->name('language-icons.store'); // Store icons
Route::delete('/icons/{id}', [LanguageIconController::class, 'destroy'])->name('language-icons.destroy'); // Delete icons

// Add this route for AJAX-based language fetching


});



Route::get('register', function () {
    return view('welcome');
});


 // For displaying the icons and upload form

Route::post('/user', [StudentController::class, 'register'])->name('user.store');



Route::get('/courses', [CourseController::class, 'getCoursesByUser'])->name('courses.index');

    Route::middleware(['admin'])->group(function () {
        // Only accessible by users with the 'admin' role and are authenticated and verified

    });



Route::get('/registration', [StudentController::class, 'fetchDataView']);


    Route::prefix('api')->group(function () {
        require base_path('routes/api.php');
    });
