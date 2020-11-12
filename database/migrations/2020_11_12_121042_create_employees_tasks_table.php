<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_tasks', function (Blueprint $table) {
            $table->char('employee_PESEL', 11);
            $table->integer('task_id')->index('employees_tasks_tasks_fk');
            $table->string('apiary_code_name', 32)->index('employees_tasks_apiaries_fk');
            $table->primary(['employee_PESEL', 'task_id', 'apiary_code_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_tasks');
    }
}
