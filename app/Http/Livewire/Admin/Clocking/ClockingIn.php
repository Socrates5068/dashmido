<?php

namespace App\Http\Livewire\Admin\Clocking;

use App\Models\Person;
use App\Models\Ticket;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Department;
use App\Models\Consultation;

class ClockingIn extends Component
{
    public $departments, $list, $status, $statusId;

    public $name, $patientId, $patients, $patient;
    public $newPatient = [
        'name' => '',
        'f_last_name' => '',
        'm_last_name' => '',
        'address' => '',
        'sex' => '',
    ];

    protected $rules = [
        'patients.*.id' => '',
        'patients.*.name' => '',

        'patient.id' => '',
        'patient.name' => '',
    ];

    protected $listeners = ['resetVariables']; 

    public function mount(){
        $this->departments = Department::all();

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

    public function tickets($department)
    {
        $this->list = $department;
    }

    public function diagnostic()
    {
        $this->validate([
            'patientId' => 'required',
        ]);
        $this->redirect(route('admin.history', $this->patientId));
    }

    public function showPatient($id)
    {
        $this->redirect(route('admin.history', $id));
    }

    public function savePatient()
    {
        $this->validate([
            'newPatient.name' => 'required|min:3',
            'newPatient.f_last_name' => 'required|min:3',
            'newPatient.m_last_name' => 'required|min:3',
            'newPatient.sex' => 'required',
            'newPatient.address' => 'required|min:5'
        ]);

        $person = new Person();
        $person->name = $this->newPatient['name'];
        $person->f_last_name = $this->newPatient['f_last_name'];
        $person->m_last_name = $this->newPatient['m_last_name'];
        $person->address = $this->newPatient['address'];
        $person->sex = $this->newPatient['sex'];
        $person->type = '1';
        $person->save();

        $patient = new Patient();
        $patient->person_id = $person->id;
        $patient->save();
        $patient->createMedicalHistory($patient->id);

        $this->emit('save');
        $this->resetVariables();
    }

    public function resetVariables()
    {
        $this->reset('newPatient', 'status', 'statusId');
        $this->resetValidation();
    }

    public function saveStatus()
    {
        $this->validate([
            'status' => 'required',
            'statusId' => 'required',
        ]);

        $ticket = Ticket::find($this->statusId);
        $ticket->status = $this->status;
        $ticket->save();

        $this->emit('save');
        $this->resetVariables();
    }

    public function render()
    {
        $tickets = Ticket::where('staff_id', auth()->user()->person->staff->id)
            ->where('date', date("Y-m-d",strtotime(now()))) //delete 1 day for production
            ->get();
        $consultations = Consultation::where('staff_id', auth()->user()->person->staff->id)->orderBy('id', 'desc')->paginate(5);

        return view('livewire.admin.clocking.clocking-in', compact('tickets', 'consultations'))->layout('layouts.admin');
    }
}
