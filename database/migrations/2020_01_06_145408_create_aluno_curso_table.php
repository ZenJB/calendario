<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoCursoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_curso', function(Blueprint $table)
		{
			$table->integer('aluno_id')->unsigned()->index();
			$table->integer('curso_id')->unsigned()->index();
			$table->primary(['aluno_id','curso_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_curso');
	}

}
