<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(TimeTableSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(CardSeeder::class);
        // $this->call(PositionSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
