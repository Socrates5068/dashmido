<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;

class Home extends Component
{
    public function render()
    {
        $departments = Department::where('name', '!=', 'Administración')
                                    ->where('name', '!=', 'Enfermería')->get();

        return view('livewire.home', compact('departments'));
    }
}
