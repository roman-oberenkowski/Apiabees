<?php

namespace Database\Seeders;

use App\Models\Apiary;
use App\Models\HoneyProduction;
use App\Models\WaxProduction;
use Illuminate\Database\Seeder;

class WaxProductionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f=\Faker\Factory::create('pl_PL');

        $apiaries=Apiary::get();

        for ($i=0;$i<100;$i++){
            WaxProduction::create([
                'produced_at' => $f->dateTimeBetween(),
                'produced_weight' => $f->numberBetween(10,50),
                'apiary_code_name' => $apiaries[rand(0,sizeof($apiaries)-1)]->code_name
            ]);

        }
    }
}


