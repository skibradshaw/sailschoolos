<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChartersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('charters', function (Blueprint $table) {
            $table->foreign('boat_id', 'FK1_charters')->references('id')->on('boats')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charters', function (Blueprint $table) {
            $table->dropForeign('FK1_charters');
        });
    }
}
