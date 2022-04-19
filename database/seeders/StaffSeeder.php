<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::create([
            'people_id' => '1',
            'position_id' => '1',
            'user_id' => '1',
            'email' => 'Admin',
        ]);

        Staff::create([
            'people_id' => '2',
            'position_id' => '2',
            'user_id' => '2',
            'email' => 'Admin',
        ]);

        Staff::create([
            'people_id' => '3',
            'position_id' => '3',
            'user_id' => '3',
            'email' => 'Admin',
        ]);
    }
}
