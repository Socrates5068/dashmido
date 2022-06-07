<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    CONST FIRST = "DIAGNOSTICO PRESUNTIVO";
    CONST SECOND = "EN TRATAMIENTO";
    CONST THIRD = "TERMINADO";

    use HasFactory;
}
