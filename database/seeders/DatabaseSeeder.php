<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use \App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //Type seeders
            ActionTypeSeeder::class,
            HoneyTypeSeeder::class,
            TaskTypeSeeder::class,
            StateTypeSeeder::class,
            SpecieSeeder::class,
            //other seeders
            ApiarySeeder::class,
            HiveSeeder::class,
            BeeFamilySeeder::class,
            EmployeeSeeder::class,
            AttendanceSeeder::class,


            //testing seeders
            UserSeeder::class,
        ]);
    }

}
