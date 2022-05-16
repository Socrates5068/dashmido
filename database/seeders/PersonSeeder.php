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
            'sex' => 'Masculino',
        ]);

        Person::create([
            'name' => 'Jairo ',
            'f_last_name' => 'Carrion',
            'm_last_name' => 'Carrion',
            'ci' => '12012568',
            'address' => 'Calle XX 96',
            'telephone' => '74853652',
            'type' => '0',
            'sex' => 'Masculino',
        ]);

        Person::create([
            'name' => 'Elias ',
            'f_last_name' => 'Ramos',
            'm_last_name' => 'Ramos',
            'ci' => '1207568',
            'address' => 'Calle XX 22',
            'telephone' => '74878652',
            'type' => '0',
            'sex' => 'Masculino',
        ]);

        Person::create([
            'name' => 'Maria Eugenia ',
            'f_last_name' => 'Sierra',
            'm_last_name' => 'Sierra',
            'ci' => '12496568',
            'address' => 'Calle XX 41',
            'telephone' => '74856552',
            'type' => '0',
            'sex' => 'Femenino',
        ]);

        Person::create([
            'name' => 'Paciente',
            'f_last_name' => 'Paciente',
            'm_last_name' => 'Paciente',
            'ci' => '9524869',
            'address' => 'Calle XX 562',
            'telephone' => '6224589',
            'type' => '1',
            'sex' => 'Masculino',
        ]);
    }
}
