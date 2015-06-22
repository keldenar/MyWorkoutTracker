<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkoutExerciseValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workout_exercise_values', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer("workout_exercise_id")->unsigned();
            $table->foreign("workout_exercise_id")->references("id")->on("workout_exercises")->onDelete("cascade");
            $table->string("value");
            $table->integer("internal_type_id")->unsigned();
            $table->foreign("internal_type_id")->references("id")->on("internal_types");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workout_exercise_values');
	}

}
