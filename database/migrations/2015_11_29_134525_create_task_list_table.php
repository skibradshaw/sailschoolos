<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskListTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->nullable()->index('FK1_task_list');
            $table->integer('for_user_id')->unsigned()->nullable()->index('FK2_task_list');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task_list');
    }
}
