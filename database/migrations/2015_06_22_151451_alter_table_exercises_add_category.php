<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableExercisesAddCategory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('exercises', function(Blueprint $table)
        {
            $table->integer("exercise_category_id")->unsigned();
            $table->foreign("exercise_category_id")->references("id")->on("exercise_categories")->onDelete("cascade");
            $table->text("description");
            $table->text("link");
            $table->text("video_link");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
