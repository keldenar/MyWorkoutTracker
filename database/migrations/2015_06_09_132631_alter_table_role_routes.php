<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRoleRoutes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('role_routes', function(Blueprint $table)
		{
            $table->dropForeign('role_routes_role_id_foreign');
            $table->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('role_routes', function(Blueprint $table)
		{
			//
		});
	}

}
