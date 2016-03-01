<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToResponseTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('response_templates', function (Blueprint $table) {
            //
            $table->foreign('user_type_id','fk_user_type_id')->references('id')->on('user_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('response_templates', function (Blueprint $table) {
            //
            $table->dropForeign('fk_user_type_id');
        });
    }
}
