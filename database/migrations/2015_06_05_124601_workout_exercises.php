<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkoutExercises extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workout_exercises', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer("workout_id")->unsigned();
            $table->foreign("workout_id")->references("id")->on("workouts");
            $table->integer("exercise_id")->unsigned();
            $table->foreign("exercise_id")->references("id")->on("exercises");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workout_exercises');
	}

}
