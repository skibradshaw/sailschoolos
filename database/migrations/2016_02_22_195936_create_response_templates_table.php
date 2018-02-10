<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_type_id')->unsigned()->nullable();
            $table->string('trigger_event');
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
        Schema::drop('response_templates');
    }
}
