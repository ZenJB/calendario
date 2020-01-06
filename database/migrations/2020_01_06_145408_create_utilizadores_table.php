<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUtilizadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('utilizadores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('email', 191);
			$table->string('password', 191);
			$table->dateTime('email_verified_at')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('identificacao_uma')->default('0')->comment('Numero de aluno ou outro parametro');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('utilizadores');
	}

}
