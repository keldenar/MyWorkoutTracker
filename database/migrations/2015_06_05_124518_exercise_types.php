<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExerciseTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercise_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->string("name");
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
		Schema::drop('exercise_types');
	}

}
