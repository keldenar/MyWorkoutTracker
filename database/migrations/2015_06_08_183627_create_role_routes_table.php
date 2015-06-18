<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleRoutesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_routes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer('role_id')->unsigned();
            $table->foreign("role_id")->references("id")->on("roles");
            // TODO this is probably naive and will need to be enhanced later.
            $table->enum("method",["GET","POST","PUT","DELETE"]);
            $table->string("route");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_routes');
	}

}
