<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tr_id',
        'fee',
        'receipt',
    ];

    // Optional: Define the relationship with the User model (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
