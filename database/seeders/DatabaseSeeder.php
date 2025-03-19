<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(NationalitieSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(ParentSeeder::class);
    }
}
