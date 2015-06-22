<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerciseValueTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercise_value_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer("internal_type_id")->unsigned();
            $table->integer("exercise_id")->unsigned();
            $table->foreign("internal_type_id")->references("id")->on("internal_types")->onDelete("cascade");
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
		Schema::drop('exercise_value_types');
	}

}
