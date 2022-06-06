<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'person_id' => 6,
            'blood_type' => 'B-',
            'weight' => '70',
            'height' => '1.56',
            'old' => 30,
        ]);
        
    }
}
