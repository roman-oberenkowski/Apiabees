<?php

namespace Database\Seeders;

use App\Models\Apiary;
use App\Models\HoneyProduction;
use Illuminate\Database\Seeder;
use \App\Models\HoneyType;

class HoneyTypesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=['Wrzosowy', 'Rzepakowy', 'Akacjowy', 'Gryczany', 'Wielokwiatowy','Spadziowy'];

        $types = [];

        foreach ($arr as $ht){
            $rec=new HoneyType;
            $rec->name= $ht;
            $rec->save();
            array_push($types, $rec);
        }
    }
}


