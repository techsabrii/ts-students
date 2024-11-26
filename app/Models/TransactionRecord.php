<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionRecord extends Model
{
    use HasFactory;

    // Define the table name (optional if it follows Laravel's convention)
    protected $table = 'transactions_record';

    // Define the fillable attributes
    protected $fillable = [
        'user_id',
        'course_name',
        'month',
        'tr_id',
        'receipt_url',
        'status',
    ];

    // Define relationships (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
