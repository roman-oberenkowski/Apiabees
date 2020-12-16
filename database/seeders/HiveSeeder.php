<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Hive;


class HiveSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mat=['Plastikowy','Drewniany','Metalowy'];
        for ($i=0;$i<15;$i++){
            $rec=new Hive;
            $rec->material= $mat[rand(0,2)];
            $rec->save();
        }
        
    }
}


