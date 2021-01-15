<?php

namespace Database\Seeders;

use App\Models\Apiary;
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
        $apiaries=Apiary::get(['code_name','col_num','row_num']);
        $f=\Faker\Factory::create('pl_PL');
        $mat=['Plastic','Wooden','Metal','Other'];
        for ($i=0;$i<22;$i++){
            $rec=new Hive;
            $rec->material= $mat[rand(0,2)];
            if(rand(0,1))
                $rec->qr_code=$f->ean8();
            if(rand(0,1))
                $rec->nfc_tag=$f->ean8();
            if(rand(0,1)){
                //losuj pasiekę
                do{
                    $apiary_num=rand(0,sizeof($apiaries)-1);
                    $acn_temp=$apiaries[$apiary_num]->code_name;
                    $a_cols=$apiaries[$apiary_num]->col_num;
                    $a_rows=$apiaries[$apiary_num]->row_num;
                    //error_log("A $acn_temp B $a_cols C $a_rows D $apiary_num");
                }
                //do czasu kiedy będzie na niej wystarczająco miejsca
                while(Hive::where('apiary_code_name',$acn_temp)->count()>=$a_cols*$a_rows-1);
                $rec->apiary_code_name=$acn_temp;
                do{
                    $pos_col=rand(1,$a_cols);
                    $pos_row=rand(1,$a_rows);
                }while(Hive::where('apiary_code_name',$rec->apiary_code_name)->where('location_row',$pos_row)->where('location_column',$pos_col)->count()!=0);
                $rec->location_column=$pos_col;
                $rec->location_row=$pos_row;
            }
            $rec->save();
        }
    }
}


