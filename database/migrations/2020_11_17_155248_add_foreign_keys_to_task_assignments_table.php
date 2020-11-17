<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTaskAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_assignments', function (Blueprint $table) {
            $table->foreign('apiary_code_name', 'assigned_tasks_apiaries_fk')->references('code_name')->on('apiaries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('employee_PESEL', 'assigned_tasks_employees_fk')->references('PESEL')->on('employees')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('task_type_name', 'assigned_tasks_tasks_fk')->references('name')->on('task_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_assignments', function (Blueprint $table) {
            $table->dropForeign('assigned_tasks_apiaries_fk');
            $table->dropForeign('assigned_tasks_employees_fk');
            $table->dropForeign('assigned_tasks_tasks_fk');
        });
    }
}
