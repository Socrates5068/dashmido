<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Faker\Provider\sr_Cyrl_RS\Person;

class Position extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }
}
