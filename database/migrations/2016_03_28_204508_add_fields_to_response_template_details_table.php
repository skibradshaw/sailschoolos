<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToResponseTemplateDetailsTable extends Migration
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
            $table->string('template_file_name')->nullable()->after('template');
            $table->string('subject')->nullable()->after('template');
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
            $table->dropColumn('template_file_name');
            $table->dropColumn('subject');
        });
    }
}
