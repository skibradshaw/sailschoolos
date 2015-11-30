<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserUserTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_user_types', function(Blueprint $table)
		{
			$table->foreign('user_id', 'FK1_user_user_types')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_type_id', 'FK2_user_user_types')->references('id')->on('user_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_user_types', function(Blueprint $table)
		{
			$table->dropForeign('FK1_user_user_types');
			$table->dropForeign('FK2_user_user_types');
		});
	}

}
