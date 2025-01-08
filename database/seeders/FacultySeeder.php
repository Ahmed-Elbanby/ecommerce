<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;
use Faker\Factory as Faker;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $i = 1;
        foreach (range(1,  5) as $index) {
            Faculty::create([
                'name' => 'Faculty' . $i,
                'note' => 'Fake Data',
            ]);
            $i++;
        }
    }
}
