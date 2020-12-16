<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabase extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared(file_get_contents('Database.sql'));
        DB::unprepared(file_get_contents('DatabaseFunctions.sql'));
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {

    }
}
