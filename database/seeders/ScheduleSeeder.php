<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\TimeTable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScheduleSeeder extends Seeder
{    
    public function run()
    {
        $schedule = new Schedule();
        $schedule->time = TimeTable::find(1)->time;
        $schedule->department_id = 4;
        $schedule->staff_id = 3; //refers to the staff id
        $schedule->type = 1;
        $schedule->time_table_id = 1;
        $schedule->save();

        $schedule = new Schedule();
        $schedule->time = TimeTable::find(2)->time;
        $schedule->department_id = 3;
        $schedule->staff_id = 4;
        $schedule->type = 2;
        $schedule->time_table_id = 2;
        $schedule->save();

        $schedule = new Schedule();
        $schedule->time = TimeTable::find(3)->time;
        $schedule->department_id = 5;
        $schedule->staff_id = 5;
        $schedule->type = 3;
        $schedule->time_table_id = 3;
        $schedule->save();
    }
}
