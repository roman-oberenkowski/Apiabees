<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEmployeesTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees_tasks', function (Blueprint $table) {
            $table->foreign('apiary_code_name', 'employees_tasks_apiaries_fk')->references('code_name')->on('apiaries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('employee_PESEL', 'employees_tasks_employees_fk')->references('PESEL')->on('employees')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('task_id', 'employees_tasks_tasks_fk')->references('id')->on('tasks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees_tasks', function (Blueprint $table) {
            $table->dropForeign('employees_tasks_apiaries_fk');
            $table->dropForeign('employees_tasks_employees_fk');
            $table->dropForeign('employees_tasks_tasks_fk');
        });
    }
}
