<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'dob',
        'class',
        'profile_image',
        'school_id', 
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
