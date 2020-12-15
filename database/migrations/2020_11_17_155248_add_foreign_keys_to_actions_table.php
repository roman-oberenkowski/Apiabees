<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actions', function (Blueprint $table) {
            $table->foreign('action_type_name', 'actions_action_types_fk')->references('name')->on('action_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('employee_PESEL', 'actions_employees_fk')->references('PESEL')->on('employees')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            //$table->foreign('hive_id', 'actions_hives_fk')->references('id')->on('hives')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actions', function (Blueprint $table) {
            $table->dropForeign('actions_action_types_fk');
            $table->dropForeign('actions_employees_fk');
            $table->dropForeign('actions_hives_fk');
        });
    }
}
