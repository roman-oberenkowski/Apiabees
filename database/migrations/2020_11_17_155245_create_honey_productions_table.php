<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoneyProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honey_productions', function (Blueprint $table) {
            $table->id();
            $table->date('produced_at');
            $table->decimal('produced_weight', 10);
            $table->string('honey_type_name', 32)->index('honey_productions_types_fk');
            $table->string('apiary_code_name', 32);
            $table->unique(['apiary_code_name', 'produced_at'], 'honey_productions__idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('honey_productions');
    }
}
