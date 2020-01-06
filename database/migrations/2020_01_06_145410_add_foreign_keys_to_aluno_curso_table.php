<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunoCursoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aluno_curso', function(Blueprint $table)
		{
			$table->foreign('aluno_id')->references('id')->on('alunos')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('curso_id')->references('id')->on('curso')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aluno_curso', function(Blueprint $table)
		{
			$table->dropForeign('aluno_curso_aluno_id_foreign');
			$table->dropForeign('aluno_curso_curso_id_foreign');
		});
	}

}
