<?php

namespace App\Http\Livewire\Admin\Clocking;

use App\Models\Person;
use App\Models\Ticket;
use Livewire\Component;
use App\Models\Department;
use App\Models\Consultation;

class ClockingIn extends Component
{
    public $departments, $list;

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

    public function render()
    {
        $tickets = Ticket::where('doctor_id', auth()->user()->person->id)
            ->where('date', date("Y-m-d",strtotime(now()))) //delete 1 day for production
            ->get();
        $consultations = Consultation::where('staff_id', auth()->user()->person->staff->id)->orderBy('id', 'desc')->paginate(5);

        return view('livewire.admin.clocking.clocking-in', compact('tickets', 'consultations'))->layout('layouts.admin');
    }
}
