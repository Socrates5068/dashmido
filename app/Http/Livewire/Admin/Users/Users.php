<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        return view('livewire.admin.users.users')->layout('layouts.admin');
    }
}
