<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScheduleSeeder extends Seeder
{
    public $morning = [
        '09:00',
        '09:20',
        '09:40',
        '10:00',
        '10:20',
        '10:40',
        '11:00',
        '11:20',
        '11:40',
    ];

    public $afternoon = [
        '15:00',
        '15:20',
        '15:40',
        '16:00',
        '16:20',
        '16:40',
        '17:00',
        '17:20',
        '17:40',
    ];

    public $night = [
        '18:00',
        '18:20',
        '18:40',
        '19:00',
        '19:20',
        '19:40',
        '20:00',
        '20:20',
        '20:40',
    ];
    
    public function run()
    {
        $schedule = new Schedule();
        $schedule->time = json_encode($this->morning);
        $schedule->department_id = 3;
        $schedule->doctor_id = 2;
        $schedule->type = 1;
        $schedule->save();

        $schedule = new Schedule();
        $schedule->time = json_encode($this->afternoon);
        $schedule->department_id = 3;
        $schedule->doctor_id = 3;
        $schedule->type = 2;
        $schedule->save();

        $schedule = new Schedule();
        $schedule->time = json_encode($this->night);
        $schedule->department_id = 3;
        $schedule->doctor_id = 4;
        $schedule->type = 3;
        $schedule->save();

        $schedule = new Schedule();
        $schedule->time = json_encode($this->morning);
        $schedule->department_id = 4;
        $schedule->doctor_id = 3;
        $schedule->type = 1; //refers it to the schedule (morning, afternoon o night)
        $schedule->save();
    }
}
