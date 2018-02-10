<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusChangeUserIdToResponseSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('response_schedules', function (Blueprint $table) {
            //
            $table->integer('status_change_user_id')->unsigned()->nullable();
            $table->foreign('status_change_user_id','FK1_status_change_user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('response_schedules', function (Blueprint $table) {
            //
            $table->dropForeign('FK1_status_change_user_id');
            $table->dropColumn('status_change_user_id');
        });
    }
}
