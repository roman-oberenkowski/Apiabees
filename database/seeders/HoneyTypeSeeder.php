<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\HoneyType;

class HoneyTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=['Wrzosowy', 'Rzepakowy', 'Akacjowy', 'Gryczany', 'Wielokwiatowy','Spadziowy']; 
        foreach ($arr as $ht){
            $rec=new HoneyType;
            $rec->name= $ht;
            $rec->save();
        }
        
    }
}


