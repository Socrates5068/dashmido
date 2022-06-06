<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consultation = new Consultation();
        $consultation->patient_id = 1;
        $consultation->staff_id = 3;
        $consultation->description = "some text";
        $consultation->status = Consultation::FIRST;
        $consultation->save();

        $consultation = new Consultation();
        $consultation->patient_id = 1;
        $consultation->staff_id = 3;
        $consultation->description = "some text";
        $consultation->status = Consultation::SECOND;
        $consultation->save();

        $consultation = new Consultation();
        $consultation->patient_id = 1;
        $consultation->staff_id = 3;
        $consultation->description = "some text";
        $consultation->status = Consultation::THIRD;
        $consultation->save();
    }
}
