<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Person;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class Patients extends Component
{
    use WithPagination;

    public $editUser = false;

    public $user = [
        'name' => '',
        'f_last_name' => '',
        'm_last_name' => '',
        'ci' => '',
        'address' => '',
        'telephone' => '',
        'blood_type' => '',
        'weight' => '',
        'height' => '',
        'old' => '',
        'sex' => '',
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
    ];
    public $roles, $role, $deleteRole;
    public $aux;

    protected $listeners = ['updateSearch', 'resetVariables', 'updateUser'];

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

    public function saveUser()
    {
        $this->validate([
            'user.name' => 'required|min:3',
            'user.f_last_name' => 'required|min:3',
            'user.m_last_name' => 'required|min:3',
            'user.ci' => 'required|unique:people,ci',
            'user.address' => 'required|min:6',
            'user.telephone' => 'required|numeric',
            'user.blood_type' => 'nullable|max:5',
            'user.weight' => 'nullable|max:8|min:1',
            'user.height' => 'nullable|max:8|min:1',
            'user.old' => 'nullable|numeric|max:120|min:0',
            'user.sex' => 'required',
        ]);

        $person = new Person;
        $person->name = $this->user['name'];
        $person->f_last_name = $this->user['f_last_name'];
        $person->m_last_name = $this->user['m_last_name'];
        $person->ci = $this->user['ci'];
        $person->address = $this->user['address'];
        $person->telephone = $this->user['telephone'];
        $person->type = '1';
        $person->sex = $this->user['sex'];
        $person->save();

        $patient = new Patient;
        $patient->person_id = $person->id;
        $patient->blood_type = $this->user['blood_type'];
        $patient->weight = $this->user['weight'];
        $patient->height = $this->user['height'];
        $patient->old = $this->user['old'];
        $patient->save();
        $patient->createMedicalHistory($patient->id);

        $user = new User;
        $user->person_id = $person->id;
        $user->name = $person->name;
        $user->username = $person->ci;
        $user->password = bcrypt($this->user['ci']);
        $user->save();
        $user->assignRole('Paciente');

        $this->emit('save');
        $this->reset('user');
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
            'sex' => $person->sex,
            'blood_type' => $person->patient->blood_type,
            'weight' => $person->patient->weight,
            'height' => $person->patient->height,
            'old' => $person->patient->old,
        ];
    }

    public function updateUser(Person $person)
    {
        if ($person->ci == $this->user['ci']) {
            if ($person->telephone == $this->user['telephone']) {
                $this->validate([
                    'user.name' => 'required|min:3',
                    'user.f_last_name' => 'required|min:3',
                    'user.m_last_name' => 'required|min:3',
                    'user.ci' => 'required|exists:people,ci',
                    'user.address' => 'required|min:6',
                    'user.telephone' => 'required|numeric|exists:people,telephone',
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
                    'user.ci' => 'required|exists:people,ci',
                    'user.address' => 'required|min:6',
                    'user.telephone' => 'required|numeric|unique:people,telephone',
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
            }
        } else {
            if ($person->telephone == $this->user['telephone']) {
                $this->validate([
                    'user.name' => 'required|min:3',
                    'user.f_last_name' => 'required|min:3',
                    'user.m_last_name' => 'required|min:3',
                    'user.ci' => 'required|unique:people,ci',
                    'user.address' => 'required|min:6',
                    'user.telephone' => 'required|numeric|exists:people,telephone',
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
                    'user.ci' => 'required|unique:people,ci',
                    'user.address' => 'required|min:6',
                    'user.telephone' => 'required|numeric|unique:people,telephone',
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
            }
        }

        $user = User::where('person_id', $person->id)->first();
        $user->username = $person->ci;
        $user->save();

        $this->editUser = false;

        $this->emit('save');
        $this->reset('user', 'aux');
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
        $users = Person::where(function ($query) {
            $query->where('type', '1');
            $query->where('name', 'like', '%' . $this->search . '%');
            // $query->orwhere('address', 'like', '%'.$this->search.'%');
        })->orderBy('created_at', 'desc')->paginate($this->paginate);

        $departments = Department::all();

        return view('livewire.admin.users.patients', compact('users', 'departments'))->layout('layouts.admin');
    }
}
