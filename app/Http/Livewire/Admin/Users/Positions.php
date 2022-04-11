<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\Department;

class Positions extends Component
{
    public $departments, $department, $aux;

    protected $listeners = ['resetVariables', 'deleteDepartment'];

    public function mount()
    {
        
    }

    public function saveDepartment()
    {
        $this->validate([
            'department' => 'required',
        ]);

        $department = new Department;
        $department->name = $this->department;
        $department->save();

        $this->resetVariables();
        $this->emit('saveDepartment');
    }

    public function editDepartment(Department $department)
    {
        $this->aux = $department->id;
        $this->department = $department->name;
    }

    public function updateDepartment(Department $department)
    {
        $this->validate([
            'department' => 'required',
        ]);

        $department->name = $this->department;
        $department->save();

        $this->resetVariables();
        $this->emit('saveDepartment');
    }

    public function deleteDepartment(Department $department)
    {
        $department->delete();
    }

    public function resetVariables()
    {
        $this->reset('department');
    }

    public function render()
    {
        $this->departments = Department::all();

        return view('livewire.admin.users.positions')->layout('layouts.admin');
    }
}
