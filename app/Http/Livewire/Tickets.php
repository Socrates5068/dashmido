<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\User;
use App\Models\Ticket;
use Livewire\Component;
use App\Models\Department;

class Tickets extends Component
{
    public $departments, $list, $a;

    public function mount()
    {
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

        if (!is_null(auth()->user()->status)) {
            $user = User::find(auth()->user()->id);
            $status = json_decode($user->status, true);
            array_push($status, $ticket->department_id);
            auth()->user()->status = json_encode($status);

            $user->status = json_encode($status);
            $user->save();
        } else {
            $status = [];
            array_push($status, $ticket->department_id);
            auth()->user()->status = json_encode($status);

            $user = User::find(auth()->user()->id);
            $user->status = json_encode($status);
            $user->save();
        }

        $card = new Card();
        $card->patient_id = auth()->user()->person->patient->id;
        $card->date = $ticket->date;
        $card->time = $ticket->time;
        $card->doctor_id = $ticket->doctor_id;
        $card->department_id = $ticket->department_id;
        $card->save();

        $this->emit("save");
    }

    public function booked()
    {
        $this->a = 'popo';
    }

    public function render()
    {
        $tickets = Ticket::where('department_id', $this->list)
            ->where('date', date("Y-m-d", strtotime(now() . " + 1 days")))
            ->get();
        return view('livewire.tickets', compact('tickets'));
    }
}
