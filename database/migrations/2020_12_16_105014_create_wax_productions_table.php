<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaxProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wax_productions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('produced_at');
            $table->decimal('produced_weight', 10);
            $table->string('apiary_code_name', 32);
            $table->unique(['apiary_code_name', 'produced_at'], 'wax_productions__idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wax_productions');
    }
}
