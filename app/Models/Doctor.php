<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public function faculties() {
        return $this->belongsTo(Faculty::class);
    }

    public function classrooms() {
        return $this->belongsTo(Classroom::class);
    }

    public function sections() {
        return $this->belongsTo(Section::class);
    }

    public function nationalities() {
        return $this->belongsTo(Nationalitie::class);
    }
}
