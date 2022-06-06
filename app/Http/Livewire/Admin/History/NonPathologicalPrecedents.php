<?php

namespace App\Http\Livewire\Admin\History;

use Livewire\Component;
use App\Models\NonPathologicalPrecedent;

class NonPathologicalPrecedents extends Component
{
    public $patient_id, $nonPathologicalPrecedent;

    public $nonPathological = [
        'lugar_origen' => "",
        'estado_civil' => "",
        'religion' => "",
        'escolaridad' => "",
        'nacionalidad' => "",
        'lugar_residencia' => "",
        'ocupacion' => "",
        'sanguineo' => "",
    ];

    protected $listeners = ['save'];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
        $this->nonPathologicalPrecedent = NonPathologicalPrecedent::where('patient_id', $this->patient_id)->first();
        
        $this->initData();
    }

    public function save()
    {
        $this->nonPathologicalPrecedent->lugar_origen = $this->nonPathological['lugar_origen'];
        $this->nonPathologicalPrecedent->estado_civil = $this->nonPathological['estado_civil'];
        $this->nonPathologicalPrecedent->religion = $this->nonPathological['religion'];
        $this->nonPathologicalPrecedent->escolaridad = $this->nonPathological['escolaridad'];
        $this->nonPathologicalPrecedent->nacionalidad = $this->nonPathological['nacionalidad'];
        $this->nonPathologicalPrecedent->lugar_residencia = $this->nonPathological['lugar_residencia'];
        $this->nonPathologicalPrecedent->ocupacion = $this->nonPathological['ocupacion'];
        $this->nonPathologicalPrecedent->sanguineo = $this->nonPathological['sanguineo'];
        $this->nonPathologicalPrecedent->save();

        $this->emit('saved');
    }

    public function higiene($num)
    {
        $this->nonPathologicalPrecedent->higiene = $num;
        $this->nonPathologicalPrecedent->save();
    }

    public function alimentacion($num)
    {
        $this->nonPathologicalPrecedent->alimentacion = $num;
        $this->nonPathologicalPrecedent->save();
    }

    public function actividad_fisica($num)
    {
        $this->nonPathologicalPrecedent->actividad_fisica = $num;
        $this->nonPathologicalPrecedent->save();
    }

    public function alcoholismo($num)
    {
        $this->nonPathologicalPrecedent->alcoholismo = $num;
        $this->nonPathologicalPrecedent->save();
    }

    public function tabaquismo($num)
    {
        $this->nonPathologicalPrecedent->tabaquismo = $num;
        $this->nonPathologicalPrecedent->save();
    }

    public function drogas($num)
    {
        $this->nonPathologicalPrecedent->drogas = $num;
        $this->nonPathologicalPrecedent->save();
    }

    public function initData()
    {
        $this->nonPathologicalPrecedent = NonPathologicalPrecedent::where('patient_id', $this->patient_id)->first();
        
        $this->nonPathological['lugar_origen'] = $this->nonPathologicalPrecedent->lugar_origen;
        $this->nonPathological['estado_civil'] = $this->nonPathologicalPrecedent->estado_civil;
        $this->nonPathological['religion'] = $this->nonPathologicalPrecedent->religion;
        $this->nonPathological['escolaridad'] = $this->nonPathologicalPrecedent->escolaridad;
        $this->nonPathological['nacionalidad'] = $this->nonPathologicalPrecedent->nacionalidad;
        $this->nonPathological['lugar_residencia'] = $this->nonPathologicalPrecedent->lugar_residencia;
        $this->nonPathological['ocupacion'] = $this->nonPathologicalPrecedent->ocupacion;
        $this->nonPathological['sanguineo'] = $this->nonPathologicalPrecedent->sanguineo;
    }

    public function render()
    {
        $this->nonPathologicalPrecedent = NonPathologicalPrecedent::where('patient_id', $this->patient_id)->first();
        return view('livewire.admin.history.non-pathological-precedents');
    }
}
