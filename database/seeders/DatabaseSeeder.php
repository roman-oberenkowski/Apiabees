<?php

namespace Database\Seeders;

use App\Models\HoneyType;
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
            HoneyTypesSeeder::class,
            ActionTypeSeeder::class,
            TaskTypeSeeder::class,
            StateTypeSeeder::class,
            SpecieSeeder::class,
            //other seeders

            ApiarySeeder::class,
            HiveSeeder::class,
            BeeFamilySeeder::class,
            EmployeeSeeder::class,
            AttendanceSeeder::class,
            ActionSeeder::class,
            HoneyProductionSeeder::class,
            WaxProductionSeeder::class,


            //testing seeders
            UserSeeder::class,
        ]);
    }

}
