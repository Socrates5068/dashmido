<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ListUsers extends Component
{
    use WithPagination;
    
    public $paginate, $search;

    public $permissions = [
        'create_user' => false,
        'read_user' => false,
        'update_user' => false,
        'register_user' => false,
        'deregister_user' => false,
        'read_clocking' => false,
        'update_clocking' => false,
        'delete_clocking' => false,
        'create_history' => false,
        'read_history' => false,
        'update_history' => false,
        'delete_history' => false,
    ] ;
    public $roles, $role, $deleteRole;

    public $slide = 'slide';

    protected $listeners = ['updateSearch', 'resetVariables']; 

    public function mount()
    {
        $this->paginate = 10;

        $this->roles = Role::all()->pluck('name', 'id');
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

    public function saveRole()
    {       
        // create roles 
        $this->validate([
            'role' => 'required|min:4|unique:roles,name',
        ]);

        $role = Role::create(['name' => $this->role]);
        foreach ($this->permissions as $key => $permission) {
            $permission ? $role->givePermissionTo(str_replace("_", " ", $key)) : "";
        }

        $this->reset('role', 'permissions');
        $this->emit('saveRole');

        $this->roles = Role::all()->pluck('id', 'name');
    }

    public function deleteRole()
    {
        $this->validate([
            'deleteRole' => 'required'
        ]);

        $role = Role::findById($this->deleteRole);
        $role->delete();

        $this->emit('deleteRole');
        $this->reset('deleteRole');
        $this->roles = Role::all()->pluck('name', 'id');

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }

    public function resetVariables()
    {
        $this->reset('role', 'permissions');
    }

    public function saveUser()
    {
        $str = preg_replace( '/[0-9\@\.\-\"-"]+/', "", Str::uuid());
        $this->slide = $str;
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
