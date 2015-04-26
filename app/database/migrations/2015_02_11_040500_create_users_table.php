<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users',function($table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password'); // contraseña
			$table->string('name');
			$table->date('birthday');
			$table->string('photo');
			$table->bigInteger('uid_fb');
			$table->string('access_token_fb');
			$table->string('remember_token');
			//$table->rememberToken();
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
		//
		Schema:drop('users');
	}

}
