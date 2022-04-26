<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['date', 'time', 'status', 'name', 'patient_id', 'department'];

    use HasFactory;
}
