<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Staff;
use App\Models\Person;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\Department;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ListUsers extends Component
{
    use WithPagination;
    
    public $user = [
        'name' => '',
        'f_last_name' => '',
        'm_last_name' => '',
        'ci' => '',
        'address' => '',
        'telephone' => '',
        'email' => '',
        'sex' => '',
        'department' => '',
    ];
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
    public $aux;

    protected $listeners = ['updateSearch', 'resetVariables']; 

    public function mount()
    {
        $this->paginate = 10;
        $this->roles = Role::select('id', 'name')->orderBy('id', 'desc')->get();
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
        $this->emit('save');

        $this->roles = Role::select('id', 'name')->orderBy('id', 'desc')->get();
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

    public function saveUser()
    {
        $this->validate([
            'user.name' => 'required|min:3',
            'user.f_last_name' => 'required|min:3',
            'user.m_last_name' => 'required|min:3',
            'user.ci' => 'required|unique:users,username',
            'user.address' => 'required|min:6',
            'user.telephone' => 'required|numeric',
            'user.email' => 'nullable|email',
            'user.sex' => 'required',
            'role' => 'required',
            'user.department' => 'required',
        ]);

        $person = new Person;
        $person->name = $this->user['name'];
        $person->f_last_name = $this->user['f_last_name'];
        $person->m_last_name = $this->user['m_last_name'];
        $person->ci = $this->user['ci'];
        $person->address = $this->user['address'];
        $person->telephone = $this->user['telephone'];
        $person->type = '0';
        $person->sex = $this->user['sex'];
        $person->save();

        $user = new User;
        $user->person_id = $person->id;
        $user->name = $person->name;
        $user->username = $person->ci;
        $user->password = bcrypt($this->user['ci']);
        $user->save();
        $user->assignRole($this->role);

        $staff = new Staff;
        $staff->person_id = $person->id;
        $staff->department_id = $this->user['department'];
        $staff->email = $this->user['email'];
        $staff->save();

        $this->emit('save');
        $this->resetVariables();
    }

    public function editUser(Person $person)
    {
        $this->aux = $person->id;
        $this->user = [
            'name' => $person->name,
            'f_last_name' => $person->f_last_name,
            'm_last_name' => $person->m_last_name,
            'ci' => $person->ci,
            'address' => $person->address,
            'telephone' => $person->telephone,
            'email' => $person->staff->email,
            'sex' => $person->sex,
            'department' => $person->staff->department_id
        ];

        $user = User::where('person_id', $person->id)->first();
        $this->role = $user->getRoleNames()->first();
    }

    public function updateUser(Person $person)
    {
        if ($person->ci == $this->user['ci']) {
            $this->validate([
                'user.name' => 'required|min:3',
                'user.f_last_name' => 'required|min:3',
                'user.m_last_name' => 'required|min:3',
                'user.ci' => 'required|exists:users,username',
                'user.address' => 'required|min:6',
                'user.telephone' => 'required|numeric',
                'user.email' => 'nullable|email',
                'role' => 'required',
                'user.department' => 'required',
            ]);

            $person->name = $this->user['name'];
            $person->f_last_name = $this->user['f_last_name'];
            $person->m_last_name = $this->user['m_last_name'];
            $person->ci = $this->user['ci'];
            $person->address = $this->user['address'];
            $person->telephone = $this->user['telephone'];
            $person->sex = $this->user['sex'];
            $person->save();

            $user = User::where('person_id', $person->id)->first();
            $user->name = $person->name;
            $user->save();
        } else {
            $this->validate([
                'user.name' => 'required|min:3',
                'user.f_last_name' => 'required|min:3',
                'user.m_last_name' => 'required|min:3',
                'user.ci' => 'required|unique:users,username',
                'user.address' => 'required|min:6',
                'user.telephone' => 'required|numeric',
                'user.email' => 'nullable|email',
                'role' => 'required',
                'user.department' => 'required',
            ]);

            $person->name = $this->user['name'];
            $person->f_last_name = $this->user['f_last_name'];
            $person->m_last_name = $this->user['m_last_name'];
            $person->ci = $this->user['ci'];
            $person->address = $this->user['address'];
            $person->telephone = $this->user['telephone'];
            $person->sex = $this->user['sex'];
            $person->save();

            $user = User::where('person_id', $person->id)->first();
            $user->name = $person->name;
            $user->username = $person->ci;
            $user->save();
        }

        $staff = Staff::where('person_id', $person->id)->first();
        $staff->department_id = $this->user['department'];
        $staff->email = $this->user['email'];
        $staff->save();

        if ($user->getRoleNames()->first() !== $this->role) {
            $user->removeRole($user->getRoleNames()->first());
            $user->assignRole($this->role);
        }

        $this->emit('save');
        $this->reset('user', 'aux', 'role');
    }

    public function deleteUser(Person $user)
    {
        $user->delete();

        Schedule::where('doctor_id', $user->id)->delete();
    }

    public function resetPassword(Person $person)
    {

        $user = User::where('person_id', $person->id)->first();
        $user->password = bcrypt($person->ci);
        $user->save();
        $this->emit('save');
        $this->reset('user', 'aux');
    }

    public function resetVariables()
    {
        $this->reset('role', 'permissions', 'user');
        $this->resetValidation();
    }

    public function paginationView()
    {
        return 'pagination::personal';
    }

    public function register(Person $person)
    {
        $user = $person->user;
        if ($user->email_verified_at) {
            $user->email_verified_at = NULL;
            $user->save();
        } else {
            $user->email_verified_at = now();
            $user->save();
        }
    }

    public function render()
    {
        $users = Person::where(function($query){
            $query->where('type', '0');
            $query->where('name', 'like', '%'.$this->search.'%');
            // $query->orwhere('address', 'like', '%'.$this->search.'%');
        })->orderBy('created_at', 'desc')->paginate($this->paginate);

        $departments = Department::all();

        return view('livewire.admin.users.list-users', compact('users', 'departments'));
    }
}
