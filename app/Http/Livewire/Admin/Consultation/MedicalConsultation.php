<?php

namespace App\Http\Livewire\Admin\Consultation;

use Livewire\Component;
use App\Models\Consultation;
use Livewire\WithPagination;

class MedicalConsultation extends Component
{
    use WithPagination;

    public $array, $patient_id;
    public $show = 0;

    protected $listeners = ['save'];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function save($status, $description)
    {
        $consultation = new Consultation();
        $consultation->patient_id = $this->patient_id;
        $consultation->staff_id = Auth()->user()->person->staff->id;
        $consultation->description = $description;
        $consultation->status = $status;
        $consultation->save();
        $this->show = 0;

        $this->emit('saved');
    }

    public function render()
    {
        $consultations = Consultation::where('patient_id', $this->patient_id)->orderBy('created_at', 'desc')->paginate(5);

        return view('livewire.admin.consultation.medical-consultation', compact('consultations'));
    }
}
