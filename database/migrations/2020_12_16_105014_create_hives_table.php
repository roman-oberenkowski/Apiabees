<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hives', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('material', 32);
            $table->string('nfc_tag', 128)->nullable();
            $table->string('qr_code', 32)->nullable();
            $table->string('apiary_code_name', 32)->nullable()->index('hives_apiaries_fk');
            $table->integer('location_row')->nullable();
            $table->integer('location_column')->nullable();
            $table->integer('bee_family_id')->nullable()->unique('hives__idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hives');
    }
}
