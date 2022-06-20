<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    CONST PRICE = 1;

    protected $fillable = ['date', 'time', 'status', 'name', 'patient_id', 'department_id', 'staff_id'];

    use HasFactory;
}
