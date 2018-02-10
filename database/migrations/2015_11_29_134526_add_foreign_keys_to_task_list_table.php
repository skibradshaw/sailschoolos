<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTaskListTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_list', function (Blueprint $table) {
            $table->foreign('project_id', 'FK1_task_list')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('for_user_id', 'FK2_task_list')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_list', function (Blueprint $table) {
            $table->dropForeign('FK1_task_list');
            $table->dropForeign('FK2_task_list');
        });
    }
}
