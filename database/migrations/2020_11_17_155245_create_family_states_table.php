<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_states', function (Blueprint $table) {
            $table->id();
            $table->timestamp('checked_at')->useCurrent();
            $table->text('inspection_description')->nullable();
            $table->integer('bee_family_id');
            $table->string('state_type_name', 32)->index('family_states_state_types_fk');
            $table->unique(['bee_family_id', 'checked_at'], 'family_states__idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_states');
    }
}
