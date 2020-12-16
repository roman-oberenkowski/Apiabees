<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_assignments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('assignment_date')->default('CURRENT_TIMESTAMP');
            $table->char('employee_PESEL', 11);
            $table->string('task_type_name', 64)->index('assigned_tasks_tasks_fk');
            $table->string('apiary_code_name', 32)->index('assigned_tasks_apiaries_fk');
            $table->unique(['employee_PESEL', 'task_type_name', 'apiary_code_name', 'assignment_date'], 'task_assignments__idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_assignments');
    }
}
