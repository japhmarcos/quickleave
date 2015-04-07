<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leaves', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

			$table->string('type', 2);
			$table->date('from_dt');
			$table->date('to_dt');
			$table->integer('duration');
			$table->string('note', 250)->nullable();
			$table->string('remark', 250)->nullable();
			$table->string('status', 8)->default('pending');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('leaves');
		Schema::table('leaves', function($table)
		{
			$table->dropForeign('leaves_user_id_foreign');
			$table->dropColumn('user_id');
		});
	}
}
