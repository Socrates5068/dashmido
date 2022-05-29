<?php

namespace App\Http\Livewire\Admin\History;

use App\Models\Person;
use Livewire\Component;

class Template extends Component
{
    public $person;

    public function mount(Person $person)
    {
        $this->person = $person;
    }

    public function render()
    {
        return view('livewire.admin.history.template')->layout('layouts.admin');
    }
}
