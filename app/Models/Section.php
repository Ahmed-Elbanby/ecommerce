<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'faculty_id', 'classroom_id'];

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
