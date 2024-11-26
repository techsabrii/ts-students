<?php

// app/Models/Media.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'media';

    // Specify the columns that can be mass-assigned (fillable)
    protected $fillable = [
        'image_path',
        'video_path',
        'video_low_quality',
        'video_medium_quality',
        'video_high_quality'
    ];

    // Define the fields that should be cast as dates (if any, for timestamps)
    protected $dates = ['created_at', 'updated_at'];

    // If you're using a non-standard primary key (default is 'id'), define it here
    // protected $primaryKey = 'your_primary_key';

    // If the timestamp columns aren't named 'created_at' and 'updated_at', define them here
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';


    // app/Models/Media.php

public function getImageUrlAttribute()
{
    return asset('storage/' . $this->image_path);
}

public function getVideoUrlAttribute()
{
    return asset('storage/' . $this->video_path);
}

public function getLowQualityVideoUrlAttribute()
{
    return asset('storage/' . $this->video_low_quality);
}

public function getMediumQualityVideoUrlAttribute()
{
    return asset('storage/' . $this->video_medium_quality);
}

public function getHighQualityVideoUrlAttribute()
{
    return asset('storage/' . $this->video_high_quality);
}

}
