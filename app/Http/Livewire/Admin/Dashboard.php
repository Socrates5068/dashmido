<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Dashboard extends Component
{
    public $roles, $user_roles, $rol;

    public function mount()
    {
        $this->roles = User::doesntHave('roles')->first();
        $this->rol = $this->roles->getRoleNames();
        // $this->user_roles = Auth()->user()->getRoleNames();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('layouts.admin');
    }
}
