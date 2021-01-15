<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\ActionType;


class ActionTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=['Other','Honey retreive','Hive repair','NFC tag replacement','Inspection','Apply medicine','Clean'];
        foreach ($arr as $ht){
            $rec=new ActionType;
            $rec->name= $ht;
            $rec->save();
        }

    }
}


