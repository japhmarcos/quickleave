
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('team_id')->unsigned()->nullable();
			$table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
			$table->integer('manager_id')->unsigned()->nullable();
			$table->foreign('manager_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

			$table->string('username')->unique();
			$table->string('password', 60);
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email')->unique();
			$table->integer('sl_bal')->default(5)->nullable();
			$table->integer('vl_bal')->default(7)->nullable();
			$table->string('role')->nullable();		
			$table->date('date_hired')->nullable();
			$table->string('profile_img');
			$table->string('gender',1);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
		Schema::table('users', function($table)
		{
			$table->dropForeign('users_team_id_foreign','users_manager_id_foreign');
			$table->dropColumn('team_id','manager_id');
		});
	}

}
