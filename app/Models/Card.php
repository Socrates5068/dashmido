<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date',
        'time',
        'staff_id',
        'department_id'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
