<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\StateType;

class StateTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=['Wszystko ok','Mała ruchliwość','Choroba'];
        foreach ($arr as $ht){
            $rec=new StateType;
            $rec->name= $ht;
            $rec->save();
        }
    }
}


