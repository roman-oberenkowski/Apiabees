<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeeFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bee_families', function (Blueprint $table) {
            $table->id();
            $table->date('acquired_at')->useCurrent();
            $table->integer('population');
            $table->date('die_off_date')->nullable();
            $table->string('species_name', 32)->index('bee_families_species_fk');
            $table->integer('hive_id')->unique('bee_families__idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bee_families');
    }
}
