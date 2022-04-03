<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    public function render()
    {
        // $users = User::where(function($query){
        //     $query->where('name', 'like', '%'.$this->search.'%');
        //     // $query->orwhere('address', 'like', '%'.$this->search.'%');
        // })->orderBy('created_at', 'desc')->paginate($this->paginate);

        // $this->emit('render');

        return view('livewire.admin.users')->layout('layouts.admin');
    }
}
