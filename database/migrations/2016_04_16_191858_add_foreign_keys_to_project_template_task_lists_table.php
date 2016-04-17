<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToProjectTemplateTaskListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_template_task_lists', function (Blueprint $table) {
            //
            $table->foreign('project_template_id','FK1_project_template_project_template_task_list')->references('id')->on('project_templates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_template_task_lists', function (Blueprint $table) {
            //
            $table->dropForeign('FK1_project_template_project_template_task_list');
        });
    }
}
