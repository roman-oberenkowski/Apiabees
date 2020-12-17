<?php

namespace Database\Seeders;

use DateInterval;
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
            $data=$f->dateTimeBetween();
            if($f->numberBetween(0,9)<8)
                $att->finished_at=$data;
            $data->sub(new DateInterval('PT8H'));
            $att->started_at=$data;

            $att->save();
        }

    }
}


