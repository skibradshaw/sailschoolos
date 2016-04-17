<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToProjectTemplateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_template_tasks', function (Blueprint $table) {
            //
            $table->foreign('project_template_task_list_id','FK1_project_template_task_list_project_template_task')->references('id')->on('project_template_task_lists')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_template_tasks', function (Blueprint $table) {
            //
            $table->dropForeign('FK1_project_template_task_list_project_template_task');
        });
    }
}
