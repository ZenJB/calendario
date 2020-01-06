<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCadeiraCursoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cadeira_curso', function(Blueprint $table)
		{
			$table->foreign('cadeira_id')->references('id')->on('cadeira')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('cadeira_curso', function(Blueprint $table)
		{
			$table->dropForeign('cadeira_curso_cadeira_id_foreign');
			$table->dropForeign('cadeira_curso_curso_id_foreign');
		});
	}

}
