<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCadeiraDocenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cadeira_docente', function(Blueprint $table)
		{
			$table->integer('cadeira_id')->unsigned()->index();
			$table->integer('docente_id')->unsigned()->index();
			$table->primary(['cadeira_id','docente_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cadeira_docente');
	}

}
