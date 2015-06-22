<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableWorkoutExerciseChangeForeigns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('workout_exercises', function(Blueprint $table)
		{
            $table->dropForeign("workout_exercises_exercise_id_foreign");
            $table->dropForeign("workout_exercises_workout_id_foreign");
            $table->foreign("workout_id")->references("id")->on("workouts")->onDelete("cascade");
            $table->foreign("exercise_id")->references("id")->on("exercises")->onDelete("cascade");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('workout_exercises', function(Blueprint $table)
		{
			//
		});
	}

}
