<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToResponseTemplateDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('response_template_details', function (Blueprint $table) {
            //
            $table->foreign('response_template_id','fk_response_template_id')->references('id')->on('response_templates')->onUpdate('NO ACTION')->onDelete('NO ACTION');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('response_template_details', function (Blueprint $table) {
            //
            $table->dropForeign('fk_response_template_id');
        });
    }
}
