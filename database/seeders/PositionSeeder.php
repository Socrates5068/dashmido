<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'department_id' => 1,
            'name' => 'Secretaria',
            'description' => 'Persona que se encarga de las labores administrativas de un organismo , institución o corporación y desempeña las funciones de extender actas , dar fe de los acuerdos y custodiar los documentos de esa entidad .',
        ]);

        Position::create([
            'department_id' => 2,
            'name' => 'Ginecología',
            'description' => 'Campo de la medicina que se especializa en la atención de las mujeres durante el embarazo y el parto, y en el diagnóstico y tratamiento de enfermedades de los órganos reproductivos femeninos.',
        ]);

        Position::create([
            'department_id' => 2,
            'name' => 'Pediatría',
            'description' => 'La Pediatría es la especialidad médica que se ocupa del estudio del crecimiento y el desarrollo de los niños hasta la adolescencia, así como del tratamiento de sus enfermedades. La infancia es una etapa de la vida en continuo cambio que, desde un punto de vista biológico, se caracteriza por el crecimiento y la maduración hasta alcanzar la vida adulta.',
        ]);

        Position::create([
            'department_id' => 3,
            'name' => 'Enfermería',
            'description' => 'La enfermería abarca el cuidado autónomo y colaborativo de personas de todas las edades, familias, grupos y comunidades, enfermos o sanos y en todos los entornos. Las enfermeras están en la línea de acción en la prestación de servicios y desempeñan un papel importante en la atención centrada en la persona.',
        ]);

        Position::create([
            'department_id' => 4,
            'name' => 'Médico general',
            'description' => 'La medicina general constituye el primer nivel de atención médica y es imprescindible para la prevención, detección, tratamiento y seguimiento de las enfermedades crónicas estabilizadas, responsabilizándose del paciente en su conjunto, para decidir su derivación a los especialistas cuando alguna patología se descompense.',
        ]);

        Position::create([
            'department_id' => 3,
            'name' => 'Paciente',
            'description' => '',
        ]);

    }
}
