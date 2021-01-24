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
        $arr=['Wypełnianie dokumentów','Naprawa','Kupno sprzętu','Sprzątanie'];
        foreach ($arr as $ht){
            $rec=new ActionType;
            $rec->name= $ht;
            $rec->save();
        }

    }
}


