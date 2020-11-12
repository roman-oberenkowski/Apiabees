<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hives', function (Blueprint $table) {
            $table->foreign('apiary_code_name', 'hives_apiaries_fk')->references('code_name')->on('apiaries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('bee_family_id', 'hives_bee_families_fk')->references('id')->on('bee_families')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hives', function (Blueprint $table) {
            $table->dropForeign('hives_apiaries_fk');
            $table->dropForeign('hives_bee_families_fk');
        });
    }
}
