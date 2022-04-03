<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Laravel\Fortify\Rules\Password;

class RegisterUsers extends Component
{
        public function render()
    {
        return view('livewire.admin.register-users')->layout('layouts.admin');
    }
}
