<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->char('PESEL', 11)->primary();
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->decimal('salary', 10);
            $table->string('email', 64)->unique('employees__idx');
            $table->date('date_of_employment')->useCurrent();
            $table->date('date_of_release')->nullable();
            $table->string('appartement', 4)->nullable();
            $table->string('house_number', 8);
            $table->string('street', 32);
            $table->string('city', 32);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
