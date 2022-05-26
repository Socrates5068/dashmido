<?php

namespace App\Http\Livewire\Admin;

use App\Models\Schedule;
use Livewire\Component;
use App\Models\TimeTable;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\Null_;

class TableTime extends Component
{
    use WithPagination;

    public $name;
    public $tabletime = [];
    public $time = [
        'start' => NULL,
        'end' => NULL,
        'aux' => NULL
    ];

    protected $listeners = ['resetVariables', 'render']; 

    public function saveTableTime()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $table = new TimeTable();
        
        $table->name = $this->name;
        $table->time = json_encode($this->tabletime);
        $table->save();

        session()->flash('message');
        return redirect()->to('/admin/horarios');
    }

    public function edit($id, $key)
    {
        $this->emit('edit', $id, $key);
    }

    public function delete(TimeTable $timeTable, $key)
    {
        $time = json_decode($timeTable->time);
        unset($time[$key]);
        unset($time[$key + 1]);

        $timeTable->time = json_encode($time);
        $timeTable->save();
    }

    public function deleteTime(TimeTable $timeTable)
    {
        Schedule::where('timeTable_id', $timeTable->id)->delete();
        $timeTable->delete();
        $this->emit('delete');
    }

    public function resetVariables()
    {
        $this->resetErrorBag();
        $this->reset('time', 'name');
    }

    public function render()
    {
        $schedules = TimeTable::all();
        return view('livewire.admin.table-time', compact('schedules'))->layout('layouts.admin');
    }
}
