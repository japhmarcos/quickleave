<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsFkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('teams', function($table)
		{
			$table->integer('manager_id')->unsigned()->nullable();
			$table->foreign('manager_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('teams', function($table)
		{
			$table->dropForeign('teams_manager_id_foreign');
			$table->dropColumn('manager_id');
		});//
	}

}
