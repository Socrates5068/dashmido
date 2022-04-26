<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Department;
use Illuminate\Console\Command;

class MakeTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Agrega el fichaje';
    public $hours = [
        '9:00',
        '9:20',
        '9:40',
        '10:00',
        '10:20',
        '10:40',
        '11:00',
        '11:20',
        '11:40',
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $departments = Department::all();
        $now = Carbon::now()->toDateString();
        foreach ($departments as $key => $department) {
            foreach ($this->hours as $hour) {
                Ticket::create([
                    'date' => now(),
                    'time' => $hour,
                    'department' => $department->name,
                ]);
            }
        }
        
    }
}
