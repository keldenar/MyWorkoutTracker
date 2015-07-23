<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerciseSuggestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercise_suggestions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->string("name");
            $table->longText("description");
            $table->longText("link");
            $table->longText("video_link");
            $table->integer("exercise_category_id")->unsigned();
            $table->foreign("exercise_category_id")->references("id")->on("exercise_categories")->onDelete("cascade");
            $table->boolean("rejected")->default(false);
            $table->string("reason");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exercise_suggestions');
	}

}
