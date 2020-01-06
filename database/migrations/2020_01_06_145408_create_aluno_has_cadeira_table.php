<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoHasCadeiraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_has_cadeira', function(Blueprint $table)
		{
			$table->integer('aluno_id');
			$table->integer('cadeira_id');
			$table->primary(['aluno_id','cadeira_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_has_cadeira');
	}

}
