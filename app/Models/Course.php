<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = [
        'user_id','course_name','language','duration','details','fees','created_at','updated_at',
    ];
    protected $casts = [
        'language' => 'array', // Ensure this is treated as an array
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
