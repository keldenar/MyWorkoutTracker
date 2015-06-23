<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseCategory extends Model {

	//
    public function Exercises()
    {
        return $this->hasMany('App\Exercise', 'exercise_category_id');
    }
}
