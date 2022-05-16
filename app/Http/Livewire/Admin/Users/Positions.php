<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\Position;
use App\Models\Department;

class Positions extends Component
{
    public $departments, $department, $aux;
    public $positions, $position, $description;
    public $users, $userDepartment;

    protected $listeners = ['resetVariables', 'deleteDepartment', 'deletePosition'];

    public function mount()
    {
        
    }

    public function saveDepartment()
    {
        $this->validate([
            'department' => 'required|min:4',
            'description' => 'required|max:2500',
        ]);

        $department = new Department;
        $department->name = $this->department;
        $department->description = $this->description;
        $department->save();

        $this->resetVariables();
        $this->emit('save');
    }

    public function editDepartment(Department $department)
    {
        $this->aux = $department->id;
        $this->department = $department->name;
        $this->description = $department->description;
    }

    public function updateDepartment(Department $department)
    {
        $this->validate([
            'department' => 'required|min:4',
        ]);

        $department->name = $this->department;
        $department->description = $this->description;

        $department->save();

        $this->resetVariables();
        $this->emit('save');
    }

    public function deleteDepartment(Department $department)
    {
        $department->delete();
    }

    public function savePosition()
    {
        $this->validate([
            'department' => 'required',
            'position' => 'required|min:4',
            'description' => 'nullable|max:255',
        ]);

        $position = new Position;
        $position->department_id = $this->department;
        $position->name = $this->position;
        $position->description = $this->description;
        $position->save();

        $this->resetVariables();
        $this->emit('save');
    }

    public function editPosition(Position $position)
    {
        $this->aux = $position->id;
        $this->department = $position->department_id;
        $this->position = $position->name;
        $this->description = $position->description;
    }

    public function updatePosition(Position $position)
    {
        $this->validate([
            'department' => 'required',
            'position' => 'required|min:4',
            'description' => 'nullable|max:255',
        ]);

        $position->department_id = $this->department;
        $position->name = $this->position;
        $position->description = $this->description;
        $position->save();

        $this->resetVariables();
        $this->emit('save');
    }

    public function deletePosition(Position $position)
    {
        $position->delete();
    }

    public function usersDepartment(Department $department)
    {
        $this->users = $department->staff;
        $this->userDepartment = $department->name;
    }

    public function resetVariables()
    {
        $this->reset('department', 'aux', 'position', 'description');
        $this->resetValidation();
    }

    public function render()
    {
        $this->departments = Department::all();
        $this->positions = Position::all();

        return view('livewire.admin.users.positions')->layout('layouts.admin');
    }
}
