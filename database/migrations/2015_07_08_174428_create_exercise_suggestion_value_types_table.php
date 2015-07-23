<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerciseSuggestionValueTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercise_suggestion_value_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer("exercise_suggestion_id")->unsigned();
            $table->foreign("exercise_suggestion_id")->references("id")->on("exercise_suggestions")->onDelete("cascade");
            $table->integer("internal_type_id")->unsigned();
            $table->foreign("internal_type_id")->references("id")->on("internal_types")->onDelete("cascade");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exercise_suggestion_value_types');
	}

}
