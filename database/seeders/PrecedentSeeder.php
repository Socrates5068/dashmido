<?php

namespace Database\Seeders;

use App\Models\Precedent;
use Illuminate\Database\Seeder;
use App\Models\PersonalPrecedent;
use App\Models\NonPathologicalPrecedent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrecedentSeeder extends Seeder
{
    public function run()
    {
        $array = [
            'Diabetes' => array(false, false, false, false, false,),
            'Hipertensión' => array(false, false, false, false, false,),
            'Cancer' => array(false, false, false, false, false,),
            'Cardiopatía' => array(false, false, false, false, false,),
            'Nefropatía' => array(false, false, false, false, false,),
            'Enfermedad de Chagas' => array(false, false, false, false, false,),
            'Tuberculosis' => array(false, false, false, false, false,),
            'ITS' => array(false, false, false, false, false,),
            'Obesidad' => array(false, false, false, false, false,),
            'Desnutrición' => array(false, false, false, false, false,),
        ];

        #Patient 1
        $precedent = new Precedent();
        $precedent->patient_id = 1;
        $precedent->familiar = json_encode($array);
        $precedent->save();

        $personalPrecedent = new PersonalPrecedent();
        $personalPrecedent->patient_id = 1;
        $personalPrecedent->save();

        $nonPathologicalPrecedent = new NonPathologicalPrecedent();
        $nonPathologicalPrecedent->patient_id = 1;
        $nonPathologicalPrecedent->save();

        #Patient 2
        $precedent = new Precedent();
        $precedent->patient_id = 2;
        $precedent->familiar = json_encode($array);
        $precedent->save();

        $personalPrecedent = new PersonalPrecedent();
        $personalPrecedent->patient_id = 2;
        $personalPrecedent->save();

        $nonPathologicalPrecedent = new NonPathologicalPrecedent();
        $nonPathologicalPrecedent->patient_id = 2;
        $nonPathologicalPrecedent->save();

        #Patient 3
        $precedent = new Precedent();
        $precedent->patient_id = 3;
        $precedent->familiar = json_encode($array);
        $precedent->save();

        $personalPrecedent = new PersonalPrecedent();
        $personalPrecedent->patient_id = 3;
        $personalPrecedent->save();

        $nonPathologicalPrecedent = new NonPathologicalPrecedent();
        $nonPathologicalPrecedent->patient_id = 3;
        $nonPathologicalPrecedent->save();
    }
}
