<?php

namespace App\Models;

use App\Models\Card;
use App\Models\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    
    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function card()
    {
        return $this->hasMany(Card::class);
    }
}
