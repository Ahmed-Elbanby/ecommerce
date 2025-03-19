<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\My_Parent; // Adjust model name if different

class ParentSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            My_Parent::create([
                'email' => "parent$i@example.com",
                'password' => bcrypt('password'),
                'father_name' => "Father $i",
                'father_nation' => "Nationality $i",
                'father_phone' => "12345678$i",
                'father_job' => "Job $i",
                'father_addres' => "Address $i",
                'mother_name' => "Mother $i",
                'mother_nation' => "Nationality $i",
                'mother_phone' => "87654321$i",
                'mother_job' => "Job $i",
                'mother_addres' => "Address $i",
            ]);
        }
    }
}