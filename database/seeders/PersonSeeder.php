<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Person::create([
            'name' => 'Administrador',
            'f_last_name' => 'Admin',
            'm_last_name' => 'Admin',
            'ci' => '8596523',
            'address' => 'Calle XX 562',
            'telephone' => '6224589',
            'type' => '0',
            'blood_type' => 'O',
            'weight' => '70',
            'height' => '170 cm',
            'old' => 30,
        ]);

        Person::create([
            'name' => 'Medico general',
            'f_last_name' => 'Medico',
            'm_last_name' => 'general',
            'ci' => '12012568',
            'address' => 'Calle XX 96',
            'telephone' => '74859652',
            'type' => '0',
            'blood_type' => 'O',
            'weight' => '70',
            'height' => '170 cm',
            'old' => 30,
        ]);

        Person::create([
            'name' => 'Paciente',
            'f_last_name' => 'Paciente',
            'm_last_name' => 'Paciente',
            'ci' => '9524869',
            'address' => 'Calle XX 562',
            'telephone' => '6224589',
            'type' => '1',
            'blood_type' => 'O',
            'weight' => '70 kg',
            'height' => '170 cm',
            'old' => 30,
        ]);
    }
}
