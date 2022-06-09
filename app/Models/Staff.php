<?php

namespace App\Models;

use App\Models\Person;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'department_id',
        'email',
    ];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function recipe()
    {
        return $this->hasMany(Recipe::class);
    }
}
