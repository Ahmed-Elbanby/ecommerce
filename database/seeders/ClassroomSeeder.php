<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\Classroom;
use Faker\Factory as Faker;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake = Faker::create();

        $faculties = Faculty::all();

        foreach ($faculties as $faculty) {
            $i = 1;
            foreach (range(1, 5) as $index) {
                Classroom::create([
                    'name' => $faculty->name. ' - Classroom' . $i,
                    'faculty_id' => $faculty->id,
                ]);
                $i++ ;
            }
        }
    }
}
