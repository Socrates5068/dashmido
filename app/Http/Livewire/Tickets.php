<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\User;
use App\Models\Ticket;
use Livewire\Component;
use App\Models\Department;

class Tickets extends Component
{
    public $departments, $list;

    public function mount() {
        $this->departments = Department::all();
        $first = Department::find(3);
        $this->list = $first->id;
    }

    public function tickets($id)
    {
        $this->list = $id;
    }

    public function book(Ticket $ticket)
    {
        $ticket->status = '1';
        $ticket->patient_id = auth()->user()->person->id;
        $ticket->save();

        auth()->user()->status = 1;

        $user = User::find(auth()->user()->id);
        $user->status = 1;
        $user->save();

        $card = new Card();
        $card->patient_id = auth()->user()->person->patient->id;
        $card->date = $ticket->date;
        $card->time = $ticket->time;
        $card->doctor_id = $ticket->doctor_id;
        $card->department_id = $ticket->department_id;
        $card->save();
    }

    public function render()
    {
        $tickets = Ticket::where('department_id', $this->list)
            ->where('date', date("Y-m-d",strtotime(now()." + 1 days")))
            ->get();
        return view('livewire.tickets', compact('tickets'));
    }
}
