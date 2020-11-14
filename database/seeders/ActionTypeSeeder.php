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

        $arr=['Inna','Pobranie miodu','Naprawa ula','Wymiana tagu NFC','Inspekcja','Aplikacja preparatu na pasożyty']; 
        foreach ($arr as $ht){
            $rec=new ActionType;
            $rec->name= $ht;
            $rec->save();
        }
        
    }
}


