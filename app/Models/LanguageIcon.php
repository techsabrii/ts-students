<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageIcon extends Model
{
    use HasFactory;

    protected $fillable = ['language_name', 'icon_path'];
}
