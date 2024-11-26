<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Support\Str;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    // Ensure the necessary attributes are fillable
    protected $fillable = [
       'role', 'name', 'email', 'password', 'student_name', 'father_name', 'date_of_birth',
        'nic', 'postal_address', 'home_address', 'contact', 'education', 'gender',
        'subject', 'decs', 'github', 'status', 'image_path','last_result_img', 'otp','reg_status','reg_date','stealth_mode', 'otp_expires_at','is_verified',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function generateOtp()
    {
        $otp = Str::random(6); // Generate a random 6-digit OTP
        $this->otp = $otp;
        $this->otp_expires_at = Carbon::now()->addMinutes(5);  // Expiration set to 5 minutes
        $this->save();
    }

    // Validate OTP and check expiration
    public function isValidOtp($otp)
    {
        return $this->otp === $otp && Carbon::now()->lessThanOrEqualTo($this->otp_expires_at);
    }

    // Mark OTP as used and set user as verified
    public function markOtpAsUsed()
    {
        $this->otp = null;
        $this->otp_expires_at = null;
        $this->is_verified = true;  // Mark the user as verified
        $this->save();
    }
    public function hasRole($role)
{
    return $this->role === $role; // Assuming you store the role as a simple field
}


public function registration()
{
    return $this->hasOne(Registration::class);
}
// In User model (app/Models/User.php)
public function courses()
{
    return $this->hasMany(Course::class); // Assuming the user has many courses
}


}
