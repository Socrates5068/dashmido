<?php

namespace App\Http\Livewire\Admin\Infirmary;

use App\Models\Order;
use App\Models\Recipe;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Attention;
use App\Models\Consultation;

class Infirmary extends Component
{
    public $description, $aux;

    // Variables for consultations
    public $show = 0;

    // variables for consultation
    public $consult, $conAux, $consultationDescription, $diagnostic, $patientId;

    protected $listeners = ['resetVariables'];

    public function edit(Attention $attention)
    {
        $this->aux = $attention->id;
        $this->description = $attention->description;
        $this->patient_id = $attention->patient_id;
    }

    public function save()
    {
        $this->validate([
            'description' => 'required',
        ]);

        $attention = new Attention();
        $attention->patient_id = $this->patientId;
        $attention->staff_id = auth()->user()->person->staff->id;
        $attention->description = $this->description;
        $attention->save();

        $this->resetVariables();
        $this->emit('saved');
    }

    public function update()
    {
        $attention = Attention::find($this->aux);
        $attention->description = $this->description;
        $attention->save();

        $this->resetVariables();
        $this->emit('saved');
    }

    public function resetVariables()
    {
        $this->reset('description');
    }

    public function editDiagnosis(Consultation $consultation)
    {
        $this->consult = $consultation;
        $this->conAux = $consultation->id;
        $this->consultationDescription = $consultation->description;
        $this->diagnostic = $consultation->diagnostic;
        $this->patientId = $consultation->patient_id;
    }

    public function render()
    {
        if ($this->consult) {
            $patients = Patient::all();
            $consultations = Consultation::where('infirmary', '1')->orderBy('id', 'desc')->paginate(10);
            $attentions = Attention::where('staff_id', auth()->user()->person->staff->id)->orderBy('id', 'desc')->paginate(5);
            
            $orders = Order::where('patient_id', $this->patientId)
                ->where('consultation_id', $this->consult->id)
                ->orderBy('id', 'desc')->paginate(5);

            $recipes = Recipe::where('patient_id', $this->patientId)
                ->where('consultation_id', $this->consult->id)
                ->orderBy('id', 'desc')->paginate(5);

                return view('livewire.admin.infirmary.infirmary', compact('consultations', 'attentions', 'patients', 'orders', 'recipes'));
        } else {
            $patients = Patient::all();
            $consultations = Consultation::where('infirmary', '1')->orderBy('id', 'desc')->paginate(10);
            $attentions = Attention::where('staff_id', auth()->user()->person->staff->id)->orderBy('id', 'desc')->paginate(5);

            return view('livewire.admin.infirmary.infirmary', compact('consultations', 'attentions', 'patients'))->layout('layouts.admin');
        }
    }
}
