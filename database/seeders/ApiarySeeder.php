<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Apiary;
use Faker\Factory;

class ApiarySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f=\Faker\Factory::create('pl_PL');
        $cns=['AB-1','AB-2','CX-1','ET-1'];
        $names=['Nasza pierwsza pasieka','Ulubiona pasieka','Nowa','Coś innego'];
        for ($i=0;$i<4;$i++){
            $rec=new Apiary;
            $rec->code_name= $cns[$i];
            $rec->name=$names[$i];
            $rec->area=rand(10,200);
            $rec->parcel=$f->numberBetween(1,100);
            $rec->street=$f->streetName;
            $rec->city=$f->city;  
            $rec->max_hives_count=$f->numberBetween(10,98)*4;
            $rec->latitude=$f->numberBetween(4900,5400)/100;
            $rec->longitude=$f->numberBetween(1400,2400)/100;                                             
            $rec->save();
        }
        
    }
}


