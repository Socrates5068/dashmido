<?php

namespace App\Http\Livewire\Admin\History;

use App\Models\Person;
use Livewire\Component;

class Template extends Component
{
    public $person, $menu;

    public function mount(Person $person)
    {
        $this->menu = 2;
        $this->person = $person;
    }

    public function menu($value)
    {
        $this->menu = $value;
    }

    public function render()
    {
        return view('livewire.admin.history.template')->layout('layouts.admin');
    }
}
