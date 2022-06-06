<?php

namespace App\Http\Livewire\Admin\History;

use Livewire\Component;
use App\Models\Precedent;
use App\Models\PersonalPrecedent;

class Precedents extends Component
{
    public $precedents, $personalPrecedent;
    public $array, $patient_id;
    public $personal = [
        "eruptivos" => "",
        "transfusionales" => "",
        "infecciosos" => "",
        "alergicos" => "",
        "traumaticos" => "",
        "quirurgicos" => "",
        "tumorales" => "",
        "enfermedades" => ""
    ];

    protected $rules = [
        'precedents.*.*' => '',
        'personal.*' => '',
    ];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
        $this->clean();
    }

    public function save($key, $index)
    {
        $this->precedents[$key][$index] = $this->precedents[$key][$index];
        $this->array->familiar = json_encode($this->precedents);
        $this->array->save();
    }

    public function eruptivos()
    {
        if (is_null($this->personal['eruptivos'])) {
            $this->personalPrecedent->eruptivos = "";
            $this->personalPrecedent->save();
        } else {
            $this->personalPrecedent->eruptivos = $this->personal['eruptivos'];
            $this->personalPrecedent->save();
            $this->emit('saved');
        }
    }

    public function transfusionales()
    {
        if (is_null($this->personal['transfusionales'])) {
            $this->personalPrecedent->transfusionales = "";
            $this->personalPrecedent->save();
        } else {
            $this->personalPrecedent->transfusionales = $this->personal['transfusionales'];
            $this->personalPrecedent->save();
            $this->emit('saved');
        }
    }

    public function infecciosos()
    {
        if (is_null($this->personal['infecciosos'])) {
            $this->personalPrecedent->infecciosos = "";
            $this->personalPrecedent->save();
        } else {
            $this->personalPrecedent->infecciosos = $this->personal['infecciosos'];
            $this->personalPrecedent->save();
            $this->emit('saved');
        }
    }

    public function alergicos()
    {
        if (is_null($this->personal['alergicos'])) {
            $this->personalPrecedent->alergicos = "";
            $this->personalPrecedent->save();
        } else {
            $this->personalPrecedent->alergicos = $this->personal['alergicos'];
            $this->personalPrecedent->save();
            $this->emit('saved');
        }
    }

    public function traumaticos()
    {
        if (is_null($this->personal['traumaticos'])) {
            $this->personalPrecedent->traumaticos = "";
            $this->personalPrecedent->save();
        } else {
            $this->personalPrecedent->traumaticos = $this->personal['traumaticos'];
            $this->personalPrecedent->save();
            $this->emit('saved');
        }
    }

    public function quirurgicos()
    {
        if (is_null($this->personal['quirurgicos'])) {
            $this->personalPrecedent->quirurgicos = "";
            $this->personalPrecedent->save();
        } else {
            $this->personalPrecedent->quirurgicos = $this->personal['quirurgicos'];
            $this->personalPrecedent->save();
            $this->emit('saved');
        }
    }

    public function tumorales()
    {
        if (is_null($this->personal['tumorales'])) {
            $this->personalPrecedent->tumorales = "";
            $this->personalPrecedent->save();
        } else {
            $this->personalPrecedent->tumorales = $this->personal['tumorales'];
            $this->personalPrecedent->save();
            $this->emit('saved');
        }
    }

    public function enfermedades()
    {
        if (is_null($this->personal['enfermedades'])) {
            $this->personalPrecedent->enfermedades = "";
            $this->personalPrecedent->save();
        } else {
            $this->personalPrecedent->enfermedades = $this->personal['enfermedades'];
            $this->personalPrecedent->save();
            $this->emit('saved');
        }
    }

    public function clean()
    {
        $this->personalPrecedent = PersonalPrecedent::where('patient_id', $this->patient_id)->first();
        if (empty($this->personalPrecedent->eruptivos)) {
            $this->personalPrecedent->eruptivos = null;
            $this->personalPrecedent->save();
        }
        if (empty($this->personalPrecedent->transfusionales)) {
            $this->personalPrecedent->transfusionales = null;
            $this->personalPrecedent->save();
        }
        if (empty($this->personalPrecedent->infecciosos)) {
            $this->personalPrecedent->infecciosos = null;
            $this->personalPrecedent->save();
        }
        if (empty($this->personalPrecedent->alergicos)) {
            $this->personalPrecedent->alergicos = null;
            $this->personalPrecedent->save();
        }
        if (empty($this->personalPrecedent->traumaticos)) {
            $this->personalPrecedent->traumaticos = null;
            $this->personalPrecedent->save();
        }
        if (empty($this->personalPrecedent->quirurgicos)) {
            $this->personalPrecedent->quirurgicos = null;
            $this->personalPrecedent->save();
        }
        if (empty($this->personalPrecedent->tumorales)) {
            $this->personalPrecedent->tumorales = null;
            $this->personalPrecedent->save();
        }
        if (empty($this->personalPrecedent->enfermedades)) {
            $this->personalPrecedent->enfermedades = null;
            $this->personalPrecedent->save();
        }
        $this->personal['eruptivos'] = $this->personalPrecedent->eruptivos;
        $this->personal['transfusionales'] = $this->personalPrecedent->transfusionales;
        $this->personal['infecciosos'] = $this->personalPrecedent->infecciosos;
        $this->personal['alergicos'] = $this->personalPrecedent->alergicos;
        $this->personal['traumaticos'] = $this->personalPrecedent->traumaticos;
        $this->personal['quirurgicos'] = $this->personalPrecedent->quirurgicos;
        $this->personal['tumorales'] = $this->personalPrecedent->tumorales;
        $this->personal['enfermedades'] = $this->personalPrecedent->enfermedades;
    }

    public function render()
    {
        $this->array = Precedent::find($this->patient_id);
        $this->precedents = json_decode($this->array->familiar, true);

        $this->personalPrecedent = PersonalPrecedent::where('patient_id', $this->patient_id)->first();

        return view('livewire.admin.history.precedents');
    }
}
