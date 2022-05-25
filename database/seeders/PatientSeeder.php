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
            'blood_type' => 'O',
            'weight' => '70 kg',
            'height' => '156 cm',
            'old' => 30,
        ]);
        
    }
}
