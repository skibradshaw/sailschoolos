<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            //
            $table->string('note_type')->nullable();
            $table->string('title')->nullable();
            $table->string('note', 10000)->nullable();
            $table->datetime('note_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            //
            $table->dropColumn('note_type');
            $table->dropColumn('note');
            $table->dropColumn('note_date');
            $table->dropColumn('title');
        });
    }
}
