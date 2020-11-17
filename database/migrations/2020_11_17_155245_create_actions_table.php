<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->char('employee_PESEL', 11);
            $table->timestamp('performed_at')->useCurrent();
            $table->text('action_description')->nullable();
            $table->integer('hive_id')->nullable()->index('actions_hives_fk');
            $table->string('action_type_name', 32)->index('actions_action_types_fk');
            $table->unique(['employee_PESEL', 'performed_at'], 'UC_actions__idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
