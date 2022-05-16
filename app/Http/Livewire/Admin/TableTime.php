<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\TimeTable;

class TableTime extends Component
{
    public $edit = false;
    public $morning = [];
    public $mtime = [
        'start' => NULL,
        'end' => NULL,
        'aux' => false
    ];

    public function mount()
    {
        $this->morning = json_decode(TimeTable::find(1)->time);
    }

    public function morning()
    {
        $this->validate([
            'mtime.start' => 'required',
            'mtime.end' => 'required',
        ]);

        array_push($this->morning, $this->mtime['start'], $this->mtime['end']);

        if (TimeTable::find(1) !== NULL) {
            TimeTable::find(1)->update([
                'id' => 1,
                'time' => json_encode($this->morning)
            ]);
        } else {
            TimeTable::create([
                'id' => 1,
                'time' => json_encode($this->morning)
            ]);
        }

        $this->resetVariables();
    }

    public function editMorning($key)
    {
        $this->mtime['start'] = $this->morning[$key];
        $this->mtime['end'] = $this->morning[$key + 1];
        $this->mtime['aux'] = true;
    }

    public function resetVariables()
    {
        $this->reset('mtime', 'edit');
    }

    public function render()
    {
        return view('livewire.admin.table-time')->layout('layouts.admin');
    }
}
