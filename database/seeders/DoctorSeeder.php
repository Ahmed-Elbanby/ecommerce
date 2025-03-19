<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
class DoctorSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            Doctor::create([
                'name' => "Doctor $i",
                'email' => "doctor$i@example.com",
                'password' => bcrypt('password'),
                'faculty_id' => 1, // Assuming faculty with ID 1 exists
                'classroom_id' => 1, // Assuming classroom with ID 1 exists
                'section_id' => 1, // Assuming section with ID 1 exists
            ]);
        }
    }
}