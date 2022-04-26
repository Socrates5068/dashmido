<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ticket;
use Livewire\Component;
use App\Models\Department;

class ClockingIn extends Component
{
    public $departments, $list;

    public function mount(){
        $this->departments = Department::all();

    }

    public function tickets($department)
    {
        $this->list = $department;
    }

    public function render()
    {
        $tickets = Ticket::where('department', $this->list)->get();

        return view('livewire.admin.clocking-in', compact('tickets'))->layout('layouts.admin');
    }
}
