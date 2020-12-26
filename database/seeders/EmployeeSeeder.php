<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Faker\Factory;
use \App\Models\Employee;
use Illuminate\Support\Facades\Hash;

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
            if($f->randomDigit%2==0){
                $emp->appartement=$f->numberBetween(1,50);
            }
            $emp->date_of_employment=$f->dateTimeBetween();

            $emp->save();

            $userData = [];
            $userData['name'] = $emp->first_name.' '.$emp->last_name;
            $userData['email'] =substr($f->unique()->email,0,64);
            $userData['password'] = Hash::make('password');
            //$userData['employee_Pesel'] = $emp->PESEL;
            $emp->user()->Create($userData);
        }
        //create employee for test_user
        $emp= Employee::create();
        $emp->PESEL='11111111111';
        $emp->first_name='Tester';
        $emp->last_name='Test';
        $emp->salary=$f->numberBetween(10,50)*200;
        $emp->house_number=$f->numberBetween(1,200);
        $emp->street=substr($f->streetName,0,32);
        $emp->city=$f->city;
        if($f->randomDigit%2==0){
            $emp->appartement=$f->numberBetween(1,50);
        }
        $emp->date_of_employment=$f->dateTimeBetween();
        $emp->save();
        $userData = [];
        $userData['name'] = $emp->first_name.' '.$emp->last_name;
        $userData['email'] = 'test@test.pl';
        $userData['password'] = Hash::make('qwerty');
        //$userData['employee_Pesel'] = $emp->PESEL;
        $emp->user()->Create($userData);
    }
}


