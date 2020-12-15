<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFamilyStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('family_states', function (Blueprint $table) {
            //$table->foreign('bee_family_id', 'family_states_bee_families_fk')->references('id')->on('bee_families')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('state_type_name', 'family_states_state_types_fk')->references('name')->on('state_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('family_states', function (Blueprint $table) {
            $table->dropForeign('family_states_bee_families_fk');
            $table->dropForeign('family_states_state_types_fk');
        });
    }
}
