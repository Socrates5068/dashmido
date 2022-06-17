<?php

namespace App\Http\Livewire\Admin\Clocking;

use App\Models\Card;
use App\Models\Person;
use App\Models\Ticket;
use Livewire\Component;
use App\Models\Department;

class ClokingToday extends Component
{
    public $departments, $list, $aux;

    public $name;
    public $patientId;
    public $patients;

    public $patient;

    protected $rules = [
        'patients.*.id' => '',
        'patients.*.name' => '',

        'patient.id' => '',
        'patient.name' => '',
    ];

    protected $listeners = ['resetVariables'];

    public function mount()
    {
        $this->departments = Department::all();
        $first = Department::find(3);
        $this->list = $first->id;

        $this->getPatients();
    }
    
    public function edit(Ticket $ticket)
    {
        $this->aux = $ticket->id;
    }

    public function updateTicket()
    {
        $this->validate([
            'patient' => 'required',
        ]);

        $ticket = Ticket::find($this->aux);

        $ticket->patient_id = $this->patient->id;
        $ticket->status = '1';
        $ticket->save();

        $person = Person::find($this->patient->id);
        if (!is_null($person->status)) {
            $status = json_decode($person->user->status, true);
            array_push($status, $ticket->department_id);
            auth()->user()->status = json_encode($status);

            $person->user->status = json_encode($status);
            $person->user->save();
        } else {
            $status = [];
            array_push($status, $ticket->department_id);

            $person->user->status = json_encode($status);
            $person->user->save();
        }

        $card = new Card();
        $card->patient_id = $person->patient->id;
        $card->date = $ticket->date;
        $card->time = $ticket->time;
        $card->doctor_id = $ticket->doctor_id;
        $card->department_id = $ticket->department_id;
        $card->save();

        $this->emit('save');
        $this->resetVariables();
    }

    public function tickets($id)
    {
        $this->list = $id;
    }

    public function updatedPatientId()
    {
        $this->patient = Person::find($this->patientId);
    }

    public function updatedName()
    {
        $this->getPatients();
    }

    public function getPatients()
    {
        $this->patients = Person::query()
            ->when($this->name, function ($query, $name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            })->where('type', '1')
            ->orderBy('name')
            ->get();
    }

    public function resetVariables()
    {
        $this->reset('name', 'patientId', 'patients', 'patient', 'aux');
        $this->resetValidation();
    }

    public function render()
    {
        $tickets = Ticket::where('department_id', $this->list)
            ->where('date', date("Y-m-d",strtotime(now())))
            ->get();
            
        return view('livewire.admin.clocking.cloking-today', compact('tickets'))->layout('layouts.admin');
    }
}
