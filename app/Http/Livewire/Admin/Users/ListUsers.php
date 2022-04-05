<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;
    public $paginate;
    public $search;

    protected $listeners = ['updateSearch']; 

    public function mount()
    {
        $this->paginate = 10;
    }

    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
        /* if (strlen($search) > 2) {
            $this->search = $search;
            $this->resetPage();
        } else {
            $this->search = "";
        } */
    }

    public function paginationView()
    {
        return 'pagination::personal';
    }

    public function render()
    {
        $users = User::where(function($query){
            $query->where('name', 'like', '%'.$this->search.'%');
            // $query->orwhere('address', 'like', '%'.$this->search.'%');
        })->orderBy('created_at', 'desc')->paginate($this->paginate);

        return view('livewire.admin.users.list-users', compact('users'));
    }
}
