<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Employee;
use App\Models\Hive;
use Illuminate\Database\Seeder;
use \App\Models\ActionType;


class ActionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $f=\Faker\Factory::create('pl_PL');
        $employees=Employee::get('PESEL');
        $action_types=ActionType::get();
        $hives=Hive::get('id');
        foreach($employees as $emp){
            $count=rand(0,6);
            for($i=0;$i<$count;$i++){
                $action=new Action;
                $action->employee_PESEL=$emp->PESEL;

                $action->performed_at=$f->dateTimeBetween();
                if(rand(0,1))
                    $action->description=$f->text;
                else
                    $action->description='';
                $action->type_name=$action_types[rand(0,sizeof($action_types)-1)]->name;
                if(rand(0,1))
                    $action->hive_id=$hives[rand(0,sizeof($hives)-1)]->id;

                $action->save();
            }
        }

    }
}


