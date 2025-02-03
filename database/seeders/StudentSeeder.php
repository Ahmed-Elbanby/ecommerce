<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => Hash::make('password'), 'birth_day' => '2000-01-01'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => Hash::make('password123'), 'birth_day' => '1999-02-02'],
            // Add more students as needed
        ] as $studentData) {
            Student::create([
                'name' => $studentData['name'],
                'email' => $studentData['email'],
                'password' => $studentData['password'],
                'birth_day' => $studentData['birth_day'],
                'facultie_id' => 1, // Assuming you have a faculty with ID 1
                'classroom_id' => 1, // Assuming you have a classroom with ID 1
                'section_id' => 1, // Assuming you have a section with ID 1
                'doctor_id' => 1, // Assuming you have a doctor with ID 1
            ]);
        }
    }
}
