<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Task;


class TaskSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=['Konserwacja uli','Utrzymywanie czystości','Pobieranie miodu','Koszenie trawy','Inspekcje co 2 dni'];
        foreach ($arr as $ht){
            $rec=new Task;
            $rec->name= $ht;
            $rec->save();
        }
        
    }
}


