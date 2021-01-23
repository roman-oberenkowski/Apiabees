<?php

namespace Database\Seeders;

use App\Models\Apiary;
use App\Models\HoneyProduction;
use Illuminate\Database\Seeder;
use \App\Models\HoneyType;

class HoneyProductionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f=\Faker\Factory::create('pl_PL');

        $types = HoneyType::get('name');
        $apiaries=Apiary::get('code_name');

        for ($i=0;$i<100;$i++){
            HoneyProduction::create([
                'produced_at' => $f->dateTimeBetween(),
                'produced_weight' => $f->numberBetween(10,50),
                'honey_type_name' => $types[rand(0, sizeof($types)-1)]->name,
                'apiary_code_name' => $apiaries[rand(0,sizeof($apiaries)-1)]->code_name
            ]);
        }
    }
}


