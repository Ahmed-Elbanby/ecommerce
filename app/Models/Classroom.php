<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'faculty_id'
    ];

    public function faculties(){
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
