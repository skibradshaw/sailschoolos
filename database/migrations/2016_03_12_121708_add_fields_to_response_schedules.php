<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToResponseSchedules extends Migration
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
            $table->integer('user_id')->unsigned();
            $table->integer('response_template_detail_id')->unsigned();
            $table->integer('most_recent_note_id')->unsigned()->nullable();
            $table->datetime('scheduled_date');
            $table->datetime('sent_date')->nullable();
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
            $table->dropColumn('user_id');
            $table->dropColumn('response_template_detail_id');
            $table->dropColumn('most_recent_note_id');
            $table->dropColumn('scheduled_date');
            $table->dropColumn('sent_date');
        });
    }
}
