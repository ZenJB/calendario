<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCadeiraCursoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cadeira_curso', function(Blueprint $table)
		{
			$table->integer('cadeira_id')->unsigned()->index();
			$table->integer('curso_id')->unsigned()->index();
			$table->primary(['cadeira_id','curso_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cadeira_curso');
	}

}
