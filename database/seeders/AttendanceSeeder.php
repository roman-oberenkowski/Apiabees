<?php

namespace Database\Seeders;

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
            $att->started_at=$f->dateTimeBetween();
            if($f->numberBetween(0,9)<8)
            $att->finished_at=$f->dateTimeBetween();
            $att->save();
        }
        
    }
}


