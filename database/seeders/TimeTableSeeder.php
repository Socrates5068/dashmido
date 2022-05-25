<?php

namespace Database\Seeders;

use App\Models\TimeTable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimeTableSeeder extends Seeder
{
    public $morning = [
        '09:00',
        '09:20',
        '09:20',
        '09:40',
        '09:40',
        '10:00',
        '10:00',
        '10:20',
        '10:20',
        '10:40',
        '10:40',
        '11:00',
        '11:00',
        '11:20',
        '11:20',
        '11:40',
    ];

    public $afternoon = [
        '15:00',
        '15:20',
        '15:20',
        '15:40',
        '15:40',
        '16:00',
        '16:00',
        '16:20',
        '16:20',
        '16:40',
        '16:40',
        '17:00',
        '17:00',
        '17:20',
        '17:20',
        '17:40',
    ];

    public $night = [
        '18:00',
        '18:20',
        '18:20',
        '18:40',
        '18:40',
        '19:00',
        '19:00',
        '19:20',
        '19:20',
        '19:40',
        '19:40',
        '20:00',
        '20:00',
        '20:20',
        '20:20',
        '20:40',
    ];

    public function run()
    {
        $table = new TimeTable();
        $table->name = "Horario mañana";
        $table->time= json_encode($this->morning);
        $table->save();

        $table = new TimeTable();
        $table->name = "Horario tarde";
        $table->time= json_encode($this->afternoon);
        $table->save();

        $table = new TimeTable();
        $table->name = "Horario noche";
        $table->time= json_encode($this->night);
        $table->save();
    }
}
