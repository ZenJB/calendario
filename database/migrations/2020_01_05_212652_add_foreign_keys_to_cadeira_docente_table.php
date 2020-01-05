<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCadeiraDocenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cadeira_docente', function(Blueprint $table)
		{
			$table->foreign('cadeira_id')->references('id')->on('cadeira')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('docente_id')->references('id')->on('docentes')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cadeira_docente', function(Blueprint $table)
		{
			$table->dropForeign('cadeira_docente_cadeira_id_foreign');
			$table->dropForeign('cadeira_docente_docente_id_foreign');
		});
	}

}
