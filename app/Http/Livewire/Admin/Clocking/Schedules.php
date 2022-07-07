<?php

namespace App\Http\Livewire\Admin\Clocking;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\TimeTable;
use App\Models\Department;

class Schedules extends Component
{
    public $personal, $time, $department, $aux, $selectedDepartment, $price;

    protected $listeners = ['selectDepartment', 'delete'];

    public function save()
    {
        $this->validate([
            'personal' => 'required',
            'time' => 'required',
            'department' => 'required',
            'price' => 'required|numeric'
        ]);

        $table = TimeTable::find($this->time);

        $ticket = new Schedule();
        $ticket->time = $table->time;
        $ticket->department_id = $this->department;
        $ticket->staff_id = $this->personal;
        if ($table->name == "Horario mañana" || $table->name == "mañana") {
            $ticket->type = 1;
        } elseif ($table->name == "Horario tarde" || $table->name == "tarde") {
            $ticket->type = 2;
        } elseif ($table->name == "Horario noche" || $table->name == "noche"){
            $ticket->type = 3;
        } else {
            $ticket->type = 4;
        }
        $ticket->time_table_id = $this->time;
        $ticket->price = $this->price;
        $ticket->save();
        
        $this->resetVariables();
        $this->emit('save');
    }

    public function edit(Schedule $schedule)
    {
        $department = Department::find($schedule->department_id);
        $this->selectDepartment($department);

        $this->personal = $schedule->staff_id;
        $this->time = $schedule->time_table_id;
        $this->department = $schedule->department_id;
        $this->price = $schedule->price;
        $this->aux = $schedule->id;
    }

    public function update()
    {
        $this->validate([
            'personal' => 'required',
            'time' => 'required',
            'department' => 'required',
            'price' => 'required|numeric'
        ]);

        $table = TimeTable::find($this->time);

        $schedule = Schedule::find($this->aux);
        $schedule->time = $table->time;
        $schedule->department_id = $this->department;
        $schedule->staff_id = $this->personal;
        if ($table->name == "Horario mañana" || $table->name == "mañana") {
            $schedule->type = 1;
        } elseif ($table->name == "Horario tarde" || $table->name == "tarde") {
            $schedule->type = 2;
        } elseif ($table->name == "Horario noche" || $table->name == "noche"){
            $schedule->type = 3;
        } else {
            $schedule->type = 4;
        }
        $schedule->time_table_id = $this->time;
        $schedule->price = $this->price;
        $schedule->save();
        
        $this->resetVariables();
        $this->emit('save');
    }

    public function delete(Schedule $schedule)
    {
        $schedule->delete();
    }

    public function resetVariables()
    {
        $this->reset('personal', 'time', 'department', 'aux');
    }

    public function selectDepartment(Department $department)
    {
        if (!is_null($department)) {
            $this->selectedDepartment = $department;
        }
    }
    
    public function setPrice(Schedule $schedule)
    {
        $schedule->price = $this->price;
        $schedule->save();
    }

    public function render()
    {
        $times = TimeTable::all();
        $staff = Staff::all();
        $schedules = Schedule::all();
        $departments = Department::all();
        
        return view('livewire.admin.clocking.schedules', compact('times', 'staff', 'schedules', 'departments'))->layout('layouts.admin');
    }
}
