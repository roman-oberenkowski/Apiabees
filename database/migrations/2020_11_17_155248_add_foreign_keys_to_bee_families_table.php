<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBeeFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bee_families', function (Blueprint $table) {
            $table->foreign('hive_id', 'bee_families_hives_fk')->references('id')->on('hives')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('species_name', 'bee_families_species_fk')->references('name')->on('species')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bee_families', function (Blueprint $table) {
            $table->dropForeign('bee_families_hives_fk');
            $table->dropForeign('bee_families_species_fk');
        });
    }
}
