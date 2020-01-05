<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCadeiraEventosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cadeira_eventos';

    /**
     * Run the migrations.
     * @table cadeira_eventos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('cadeira');
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->enum('tipo_de_evento', ['frequencia', 'projeto', 'outro']);

            $table->integer('cadeira_id')->unsigned()->index();
            $table->foreign('cadeira_id')->references('id')->on('cadeira')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
