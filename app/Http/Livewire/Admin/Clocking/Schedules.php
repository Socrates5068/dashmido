<?php

namespace App\Http\Livewire\Admin\Clocking;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\TimeTable;
use App\Models\Department;

class Schedules extends Component
{
    public $personal, $time, $department, $aux;

    public function save()
    {
        $this->validate([
            'personal' => 'required',
            'time' => 'required',
            'department' => 'required'
        ]);

        $table = TimeTable::find($this->time);

        $ticket = new Schedule();
        $ticket->time = $table->time;
        $ticket->department_id = $this->department;
        $ticket->doctor_id = $this->personal;
        if ($table->name == "Horario mañana" || $table->name == "mañana") {
            $ticket->type = 1;
        } elseif ($table->name == "Horario tarde" || $table->name == "tarde") {
            $ticket->type = 2;
        } elseif ($table->name == "Horario noche" || $table->name == "noche"){
            $ticket->type = 3;
        } else {
            $ticket->type = 4;
        }
        $ticket->timeTable_id = $this->time;
        $ticket->save();
        
        $this->resetVariables();
        $this->emit('save');
    }

    public function edit(Schedule $schedule)
    {
        $this->personal = $schedule->doctor_id;
        $this->time = $schedule->timeTable_id;
        $this->department = $schedule->department_id;
        $this->aux = $schedule->id;
    }

    public function update()
    {
        $this->validate([
            'personal' => 'required',
            'time' => 'required',
            'department' => 'required'
        ]);

        $table = TimeTable::find($this->time);

        $ticket = Schedule::find($this->aux);
        $ticket->time = $table->time;
        $ticket->department_id = $this->department;
        $ticket->doctor_id = $this->personal;
        if ($table->name == "Horario mañana" || $table->name == "mañana") {
            $ticket->type = 1;
        } elseif ($table->name == "Horario tarde" || $table->name == "tarde") {
            $ticket->type = 2;
        } elseif ($table->name == "Horario noche" || $table->name == "noche"){
            $ticket->type = 3;
        } else {
            $ticket->type = 4;
        }
        $ticket->timeTable_id = $this->time;
        $ticket->save();
        
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

    public function render()
    {
        $times = TimeTable::all();
        $staff = Staff::all();
        $schedules = Schedule::all();
        $departments = Department::all();
        
        return view('livewire.admin.clocking.schedules', compact('times', 'staff', 'schedules', 'departments'))->layout('layouts.admin');
    }
}
