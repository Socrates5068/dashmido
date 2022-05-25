<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\TimeTable;

class Time extends Component
{
    public $schedule;

    public $time = [
        'start' => NULL,
        'end' => NULL,
        'key' => NULL,
        'schedule' => NULL
    ];

    protected $listeners = ['edit'];

    public function mount($schedule)
    {
        $this->schedule = $schedule;
    }

    public function morning(TimeTable $timeTable)
    {
        $this->validate([
            'time.start' => 'required',
            'time.end' => 'required',
        ]);

        $time = json_decode($timeTable->time);

        array_push($time, $this->time['start'], $this->time['end']);
        $timeTable->time = json_encode($time);
        $timeTable->save();

        $this->resetVariables();
        $this->emit('render');
    }

    public function edit(TimeTable $timeTable, $key)
    {
        if ($this->schedule->id == $timeTable->id) {
            $time = json_decode($timeTable->time);
            $this->time['start'] = $time[$key];
            $this->time['end'] = $time[$key + 1];
            $this->time['key'] = $key;
            $this->time['schedule'] = $timeTable->id;
        }
    }

    public function update()
    {
        $this->validate([
            'time.start' => 'required',
            'time.end' => 'required',
        ]);

        $timeTable = TimeTable::find($this->time['schedule']);
        $time = json_decode($timeTable->time);

        $time[$this->time['key']] = $this->time['start'];
        $time[$this->time['key'] + 1] = $this->time['end'];

        $timeTable->time = json_encode($time);
        $timeTable->save();

        $this->resetVariables();
        $this->emit('render');
    }

    public function resetVariables()
    {
        $this->resetErrorBag();
        $this->reset('time');
    }

    public function render()
    {
        return view('livewire.admin.time');
    }
}
