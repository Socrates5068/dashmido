<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Dashboard extends Component
{
    public $role;

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('layouts.admin');
    }
}
