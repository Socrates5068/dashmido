<?php

namespace App\Http\Livewire\Admin\Clocking;

use App\Models\Card;
use App\Models\Staff;
use App\Models\Person;
use App\Models\Ticket;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Department;

class ClokingTomorrow extends Component
{
    public $departments, $list, $aux, $tickets;

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

    public $ticket;

    protected $listeners = ['resetVariables'];

    public function mount()
    {
        $this->departments = Department::where('name', '!=', 'Administración')
            ->where('name', '!=', 'Enfermería')->get();

        $first = Department::where('name', '!=', 'Administración')
            ->where('name', '!=', 'Enfermería')->first();

        if ($first) {
            $this->list = $first->id;
        }

        // $this->ticket = new Ticket();

        // $this->getPatients();
    }

    public function edit(Ticket $ticket)
    {
        $this->aux = $ticket->id;
    }

    public function updateTicket()
    {
        $this->validate([
            'patientId' => 'required',
        ]);

        $ticket = Ticket::find($this->aux);

        $person = Person::find($this->patientId);
        $ticket->patient_id = $person->patient->id;
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
        $card->staff_id = $ticket->staff_id;
        $card->department_id = $ticket->department_id;
        $card->save();

        $this->emit('save');
        $this->resetVariables();
    }

    public function tickets($id)
    {
        $this->list = $id;
        $this->resetVariables();
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
        $ticket = Ticket::find($this->ticket);
        if ($ticket) {
            $card = Card::where("time", $ticket->time)
                    ->where('date', $ticket->date)->first();

            if ($card) {
                $this->patients = Person::query()
                    ->when($this->name, function ($query, $name) {
                        return $query->where('name', 'LIKE', '%' . $name . '%');
                    })->where('type', '1')->where('id', '!=', $card->patient->person->id)
                    ->orderBy('name')
                    ->get();
            } else {
                $this->patients = Person::query()
                    ->when($this->name, function ($query, $name) {
                        return $query->where('name', 'LIKE', '%' . $name . '%');
                    })->where('type', '1')
                    ->orderBy('name')
                    ->get();
            }
        } else {
            $this->patients = Person::query()
                ->when($this->name, function ($query, $name) {
                    return $query->where('name', 'LIKE', '%' . $name . '%');
                })->where('type', '1')
                ->orderBy('name')
                ->get();
        }
    }

    public function differUser(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function resetVariables()
    {
        $this->reset('name', 'patientId', 'patients', 'patient', 'aux');
        $this->resetValidation();
    }

    public function printTickets($departmentName)
    {
        $staffId = Staff::find($this->tickets->first()->staff_id)->id;

        $pdf = \PDF::loadView('pdf.tickets', [
            'tickets' => $this->tickets,
            'departmentName' => $departmentName,
            'staffId' => $staffId
        ])->setPaper('letter', 'portrait')->output();

        return response()->streamDownload(
            fn () => print($pdf),
            'Fichas_' . now() . '_' . $departmentName . '.pdf'
        );
    }

    public function render()
    {
        $this->tickets = Ticket::where('department_id', $this->list)
            ->where('date', date("Y-m-d", strtotime(now() . " + 1 days")))
            ->get();

        return view('livewire.admin.clocking.cloking-tomorrow')->layout('layouts.admin');
    }
}
