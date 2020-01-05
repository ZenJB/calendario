<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;

class AddForeignKeysToCadeiraEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cadeira_eventos', function(Blueprint $table)
		{
			$table->foreign('cadeira_id')->references('id')->on('cadeira')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
        $user_id = User::create([

            'name' => 'Demo',
            'email' => 'demo@demo.com',
            'password' => Hash::make('demo'),
        ])->id;
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cadeira_eventos', function(Blueprint $table)
		{
			$table->dropForeign('cadeira_eventos_cadeira_id_foreign');
		});
	}

}
