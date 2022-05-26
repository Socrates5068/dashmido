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
        $tickets = Ticket::where('doctor_id', auth()->user()->person->id)
            ->where('date', date("Y-m-d",strtotime(now()."+ 1 days"))) //delete 1 day for production
            ->get();

        return view('livewire.admin.clocking-in', compact('tickets'))->layout('layouts.admin');
    }
}
