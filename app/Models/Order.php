<?php

namespace App\Models;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function staff(){
        return $this->belongsTo(Staff::class);
    }
}
