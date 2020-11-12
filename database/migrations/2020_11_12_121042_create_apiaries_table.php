<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apiaries', function (Blueprint $table) {
            $table->string('code_name', 32)->primary();
            $table->string('name', 64);
            $table->decimal('area', 10);
            $table->string('parcel', 8);
            $table->string('street', 32);
            $table->string('city', 32);
            $table->integer('max_hives_count');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apiaries');
    }
}
