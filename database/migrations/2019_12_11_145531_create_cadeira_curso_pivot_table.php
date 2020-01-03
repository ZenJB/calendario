<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCadeiraCursoPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadeira_curso', function (Blueprint $table) {
            $table->integer('cadeira_id')->unsigned()->index();
            $table->foreign('cadeira_id')->references('id')->on('cadeira')->onDelete('cascade');
            $table->integer('curso_id')->unsigned()->index();
            $table->foreign('curso_id')->references('id')->on('curso')->onDelete('cascade');
            $table->primary(['cadeira_id', 'curso_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadeira_curso');
    }
}
