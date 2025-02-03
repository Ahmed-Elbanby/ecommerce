<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'note',
    ];

    public function classrooms(){
        return $this->hasMany(Classroom::class, 'faculty_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'facultie_id');
    }
}
