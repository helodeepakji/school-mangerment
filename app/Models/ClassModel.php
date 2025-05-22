<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ClassModel extends Model
{
    use HasFactory;
    
    protected $table = 'classes';

    protected $fillable = [
        'school_id',
        'name',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
