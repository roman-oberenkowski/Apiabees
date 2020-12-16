<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHoneyProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('honey_productions', function (Blueprint $table) {
            $table->foreign('apiary_code_name', 'honey_productions_apiaries_fk')->references('code_name')->on('apiaries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('honey_type_name', 'honey_productions_types_fk')->references('name')->on('honey_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('honey_productions', function (Blueprint $table) {
            $table->dropForeign('honey_productions_apiaries_fk');
            $table->dropForeign('honey_productions_types_fk');
        });
    }
}
