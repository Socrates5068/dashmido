<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use App\Models\Department;

class Tickets extends Component
{
    public $departments, $list;

    public function mount() {
        $this->departments = Department::all();
    }

    public function tickets($department)
    {
        $this->list = $department;
    }

    public function render()
    {
        $tickets = Ticket::where('department', $this->list)->get();

        return view('livewire.tickets', compact('tickets'));
    }
}
