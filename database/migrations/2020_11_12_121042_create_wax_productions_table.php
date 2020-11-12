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
            $table->date('produced_at');
            $table->decimal('produced_weight', 10);
            $table->string('apiary_code_name', 32);
            $table->primary(['apiary_code_name', 'produced_at']);
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
