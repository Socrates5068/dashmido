<?php

namespace App\Models;

use App\Models\Card;
use App\Models\Order;
use App\Models\Person;
use App\Models\Recipe;
use App\Models\PersonalPrecedent;
use Illuminate\Database\Eloquent\Model;
use App\Models\NonPathologicalPrecedent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    
    public function createMedicalHistory($id)
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

        $precedent = new Precedent();
        $precedent->patient_id = $id;
        $precedent->familiar = json_encode($array);
        $precedent->save();

        $personalPrecedent = new PersonalPrecedent();
        $personalPrecedent->patient_id = $id;
        $personalPrecedent->save();

        $nonPathologicalPrecedent = new NonPathologicalPrecedent();
        $nonPathologicalPrecedent->patient_id = $id;
        $nonPathologicalPrecedent->save();
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
