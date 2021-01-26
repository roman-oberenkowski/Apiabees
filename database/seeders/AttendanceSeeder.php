<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Database\Seeder;
use \Faker\Factory;
use \App\Models\Attendance;
use \App\Models\Employee;

class AttendanceSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $f=\Faker\Factory::create('pl_PL');
        $employees=Employee::all('PESEL');

        for ($i=0;$i<Employee::count()*1.5;$i++){

            $att=new Attendance;
            $att->employee_PESEL=$employees[$f->numberBetween(0,Employee::count()-1)]->PESEL;
            $data=new Carbon($f->dateTimeBetween());

            $att->finished_at=$data;
            //$data->sub(new DateInterval('PT8H'));
            $data=$data->subHour(8);
            $att->started_at=$data;

            $att->save();
        }

    }
}


