<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_day',
        'facultie_id',
        'classroom_id',
        'section_id',
        'doctor_id',
    ];
    protected $table = 'stedents';

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function parent()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
