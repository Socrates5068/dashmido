<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name, $email, $password, $passwordConfirmation, $role = "user";

    protected $rules = [
        'name' => 'required|min:6|max:50',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
        'passwordConfirmation' => 'required|same:password',
        'role' => 'required'
    ];

    public function save()
    {
        $this->validate($this->rules);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.auth.register');
    }
}
