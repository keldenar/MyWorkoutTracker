<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseSuggestion extends Model {

    protected $fillable = ['name', 'description', 'link','video_link', "exercise_category_id"];
	//

}
