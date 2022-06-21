<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Staff;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultation extends Model
{
    CONST FIRST = "DIAGNOSTICO PRESUNTIVO";
    CONST SECOND = "EN TRATAMIENTO";
    CONST THIRD = "TERMINADO";
    CONST DERIVE = "DERIVADO";

    use HasFactory;

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipes::class);
    }
}
