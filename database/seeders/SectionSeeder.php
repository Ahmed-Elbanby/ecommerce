<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Section;
use Faker\Factory as Faker;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $faculties = Faculty::all();
        // $classrooms = Classroom::all();

        foreach($faculties as $faculty){

            $classrooms = Classroom::where('faculty_id', $faculty->id)->get();

            foreach($classrooms as $classroom){
                $i = 1;
                foreach(range(1, 5) as $index){
                    Section::create([
                        'name' => $classroom->name . ' - Section' . $i,
                        'status' => 'active',
                        'faculty_id' => $faculty->id,
                        'classroom_id' => $classroom->id,
                    ]);
                    $i++;
                }
            }
        }
    }
}
