<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('class_id', 'FK1_projects')->references('id')->on('classes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('charter_id', 'FK2_projects')->references('id')->on('charters')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('FK1_projects');
            $table->dropForeign('FK2_projects');
        });
    }
}
