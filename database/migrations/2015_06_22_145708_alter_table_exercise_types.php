<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableExerciseTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exercises', function(Blueprint $table)
		{
			$table->dropForeign("exercises_exercise_type_id_foreign");
            $table->dropColumn("exercise_type_id");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exercises', function(Blueprint $table)
		{
			//
		});
	}

}
