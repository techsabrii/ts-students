<?php

// app/Models/Video.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional, if it's not the plural form)
    protected $table = 'videos';

    // Specify the fields that are mass assignable (columns that you want to allow mass assignment)
    protected $fillable = [
        'title',
        'course_name',           // Title of the video
        'original_video',    // Path to the original uploaded video
        'language',           // Path to the transcoded 480p video
        'description',       // Description of the video
    ];

    // If you want to handle date columns such as created_at and updated_at,
    // ensure they are treated as Carbon instances by Laravel:
    protected $dates = ['created_at', 'updated_at'];
}
