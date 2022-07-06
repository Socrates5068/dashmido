<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\User;
use App\Models\Ticket;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\Department;

class Tickets extends Component
{
    public $departments, $list, $priceSchedule;
    public $confirm = false, $confirmTicket;

    #Paypal
    public $ticketId, $price, $paypal = false;

    protected $listeners = ['book'];

    public function mount()
    {
        $this->departments = Department::where('name', '!=', 'Administración')
            ->where('name', '!=', 'Enfermería')->get();

        $first = Department::where('name', '!=', 'Administración')
            ->where('name', '!=', 'Enfermería')->first();

        if ($first) {
            $this->list = $first->id;
            $this->priceSchedule = Schedule::where('department_id', $first->id)->first()->price;
            $this->price = round($this->priceSchedule / 6.80, 1);
        }
    }

    public function tickets($id)
    {
        $this->list = $id;
        $this->priceSchedule = Schedule::where('department_id', $id)->first()->price;
        $this->price = round($this->priceSchedule / 6.80, 1);
    }

    public function checkTicket(Ticket $ticket)
    {
        if ($ticket->status == '1') {
            $this->emit("error");
            $this->render();
        } else {
            $this->paypal = true;
        }
    }

    public function book()
    {
        $ticket = Ticket::find($this->ticketId);

        if ($ticket->status == '0') {
            $ticket->status = '1';
            $ticket->patient_id = auth()->user()->person->patient->id;
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
            $card->staff_id = $ticket->staff_id;
            $card->department_id = $ticket->department_id;
            $card->save();

            $this->paypal = false;

            $this->emit("save");
        } else {
            $this->emit("error");
            $this->render();
        }
    }

    public function changeTicket(Ticket $ticket)
    {
        #Select ticket booked
        $ticketBooked = Ticket::where('department_id', $this->list)
            ->where('patient_id', auth()->user()->person->patient->id)
            ->first();

        #Set new ticket
        $ticket->status = '1';
        $ticket->patient_id = $ticketBooked->patient_id;
        $ticket->save();

        #Unset ticket booked
        $ticketBooked->status = '0';
        $ticketBooked->patient_id = null;
        $ticketBooked->save();

        #update card
        $card = Card::where('department_id', $this->list)
            ->where('patient_id', auth()->user()->person->patient->id)->get()->last();
        $card->date = $ticket->date;
        $card->time = $ticket->time;
        $card->save();

        #reset modal
        $this->reset('confirm', 'confirmTicket');
    }

    public function confirm($key)
    {
        $this->confirm = true;
        $this->confirmTicket = $key;
    }

    public function render()
    {
        $tickets = Ticket::where('department_id', $this->list)
            ->where('date', date("Y-m-d", strtotime(now() . " + 1 days")))
            ->get();
        return view('livewire.tickets', compact('tickets'));
    }
}
