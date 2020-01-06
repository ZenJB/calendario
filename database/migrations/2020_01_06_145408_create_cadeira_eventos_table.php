<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCadeiraEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cadeira_eventos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 191);
			$table->string('descricao', 191)->nullable();
			$table->dateTime('data_inicio');
			$table->dateTime('data_fim');
			$table->enum('tipo_de_evento', array('frequencia','projeto','aula','outro'));
			$table->integer('cadeira_id')->unsigned()->index();
			$table->integer('aceite');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cadeira_eventos');
	}

}
