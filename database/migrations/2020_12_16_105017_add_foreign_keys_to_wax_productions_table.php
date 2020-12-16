<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWaxProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wax_productions', function (Blueprint $table) {
            $table->foreign('apiary_code_name', 'wax_productions_apiaries_fk')->references('code_name')->on('apiaries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wax_productions', function (Blueprint $table) {
            $table->dropForeign('wax_productions_apiaries_fk');
        });
    }
}
