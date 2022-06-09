<?php

namespace App\Http\Livewire\Admin\Infirmary;

use App\Models\Patient;
use Livewire\Component;
use App\Models\Attention;

class Infirmary extends Component
{
    public $description, $patient_id, $aux;

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
            'patient_id' => 'required',
        ]);

        $attention = new Attention();
        $attention->patient_id = $this->patient_id;
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
        $this->reset('description', 'patient_id');
    }

    public function render()
    {
        $patients = Patient::all();
        $attentions = Attention::where('staff_id', auth()->user()->person->staff->id)->orderBy('id', 'desc')->paginate(5);

        return view('livewire.admin.infirmary.infirmary', compact('patients', 'attentions'))->layout('layouts.admin');
    }
}
