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
        'gender',
        'birth_day',
        'faculty_id',
        'classroom_id',
        'section_id',
        'nationality_id',
        'parent_id',
        'doctor_id'
    ];

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

    public function nationality()
    {
        return $this->belongsTo(Nationalitie::class, 'nationality_id');
    }

    public function parent()
    {
        return $this->belongsTo(My_Parent::class, 'parent_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
