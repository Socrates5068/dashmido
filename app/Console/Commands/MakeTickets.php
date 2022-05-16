<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Schedule;
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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (User::where('status', 1)->get() as $user) {
            $user->status = 0;
            $user->save();
        }
        
        Ticket::where('date', date("Y-m-d",strtotime(now()."- 2 days")))->delete();
        
        $departments = Department::all();
        foreach ($departments as $department) {
            if ($department->name !== "Administración" && $department->name !== "Enfermería") {
                $schedules = Schedule::where('department_id', $department->id)->orderBy('type', 'asc')->get();
                foreach ($schedules as $schedule) {
                    $hours = json_decode($schedule->time);
                    foreach ($hours as $hour) {
                        Ticket::create([
                            'date' => date("Y-m-d",strtotime(now()."+ 1 days")),
                            'time' => $hour,
                            'doctor_id' => $schedule->doctor_id,
                            'department_id' => $schedule->department_id,
                        ]);
                    }
                }
            }
        }

        foreach ($departments as $department) {
            if ($department->name !== "Administración" && $department->name !== "Enfermería") {
                $schedules = Schedule::where('department_id', $department->id)->orderBy('type', 'asc')->get();
                foreach ($schedules as $schedule) {
                    $hours = json_decode($schedule->time);
                    foreach ($hours as $hour) {
                        Ticket::create([
                            'date' => date("Y-m-d",strtotime(now())),
                            'time' => $hour,
                            'patient_id' => 5,
                            'doctor_id' => $schedule->doctor_id,
                            'department_id' => $schedule->department_id,
                        ]);
                    }
                }
            }
        }
    }
}
