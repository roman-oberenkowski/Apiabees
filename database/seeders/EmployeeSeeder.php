<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Faker\Factory;
use \App\Models\Employee;

class EmployeeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f=\Faker\Factory::create('pl_PL');
        $employees=array();
        for ($i=0;$i<10;$i++){
            array_push($employees,$f->unique()->PESEL);
        }
        foreach($employees as $pesel){
            $emp= Employee::create();
            $emp->PESEL=$pesel;
            $emp->first_name=$f->firstName;
            $emp->last_name=$f->lastName;
            $emp->salary=$f->numberBetween(10,50)*200;
            $emp->house_number=$f->numberBetween(1,200);
            $emp->street=substr($f->streetName,0,32);
            $emp->city=$f->city;
            $emp->email=substr($f->unique()->email,0,32);
            if($f->randomDigit%2==0){
                $emp->appartement=$f->numberBetween(1,50);
            }
            $emp->date_of_employment=$f->dateTimeBetween();
            $emp->save();
        }
    }
}


