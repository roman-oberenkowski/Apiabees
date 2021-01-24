<?php

namespace Database\Seeders;

use App\Models\BeeFamily;
use App\Models\Hive;
use App\Models\Specie;
use DateInterval;
use Illuminate\Database\Seeder;


class BeeFamilySeeder extends Seeder
{

    public function run()
    {
        $f = \Faker\Factory::create('pl_PL');
        $species = Specie::get('name');

        for ($i = 0; $i < 20; $i++) {
            $bee_family = new BeeFamily();
            $bee_family->species_name = $species[$f->numberBetween(0, sizeof($species) - 1)]->name;
            if ($f->numberBetween(0, 7) > 6) {
                //dead
                $date = $f->dateTimeBetween();
                $bee_family->die_off_date = $date;
                $date->sub(new DateInterval('P2Y4D'));

                $bee_family->acquired_at = $date;
                $bee_family->population = 0;
                $bee_family->save();
            } else {
                //alive
                $date = $f->dateTimeBetween();
                $bee_family->acquired_at = $date;
                $bee_family->population = $f->numberBetween(10, 999);
                $bee_family->die_off_date = null;

                if (rand(0, 9)) {
                    $hive = Hive::whereNull('bee_family_id')->first();
                    $bee_family->hive_id = $hive->id;
                    $bee_family->save();
                    $hive->bee_family_id = $bee_family->id;
                    $hive->save();
                } else {
                    $bee_family->save();
                }
            }
        }
    }
}


