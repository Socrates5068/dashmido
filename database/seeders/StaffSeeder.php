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
            // 'people_id' => '1',
            'person_id' => '1',
            'department_id' => '1',
            'email' => 'admin@correo.com',
        ]);

        Staff::create([
            'person_id' => '2',
            'department_id' => '4',
            'email' => 'medico@correo.com',
        ]);
    }
}
