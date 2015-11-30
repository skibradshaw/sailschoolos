<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_types', function(Blueprint $table)
		{
			$table->foreign('type_status_id', 'FK1_user_types')->references('id')->on('type_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_types', function(Blueprint $table)
		{
			$table->dropForeign('FK1_user_types');
		});
	}

}
