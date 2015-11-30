<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('schedules', function(Blueprint $table)
		{
			$table->foreign('charter_id', 'FK1_schedules')->references('id')->on('charters')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('class_id', 'FK2_schedules')->references('id')->on('classes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('schedules', function(Blueprint $table)
		{
			$table->dropForeign('FK1_schedules');
			$table->dropForeign('FK2_schedules');
		});
	}

}
