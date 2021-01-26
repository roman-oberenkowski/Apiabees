<?php

namespace Database\Seeders;


use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f=\Faker\Factory::create('pl_PL');
        $emp= Employee::create();
        $emp->PESEL='99999999999';
        $emp->first_name='Admin';
        $emp->last_name='Admin';
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
        $userData['email'] = env('ADMIN_EMAIL');
        $userData['password'] = Hash::make(env('ADMIN_PASSWORD'));
        //$userData['employee_Pesel'] = $emp->PESEL;
        $emp->user()->Create($userData);
    }
}

