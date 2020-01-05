<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCadeiraDocentePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadeira_docente', function (Blueprint $table) {
            $table->integer('cadeira_id')->unsigned()->index();
            $table->foreign('cadeira_id')->references('id')->on('cadeira')->onDelete('cascade');
            $table->integer('docente_id')->unsigned()->index();
            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
            $table->primary(['cadeira_id', 'docente_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadeira_docente');
    }
}
