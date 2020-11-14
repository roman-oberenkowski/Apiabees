<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Specie;

class SpecieSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=[
            ['Pszczoła olbrzymia','Apis dorsata Fabr.',true],
            ['Pszczoła karłowata','Apis florea Fabr.',false],
            ['Kaukaska pszczoła miodna','Apis mellifera caucasia',true],
            ['Włoska pszczoła miodna','Apis mellifera ligustica',false]
        ]; 
        foreach ($arr as $bee){
            $rec=new Specie;
            $rec->name= $bee[0];
            $rec->latin_name=$bee[1];
            $rec->is_aggressive=$bee[2];
            $rec->save();
        }
        
    }
}


