<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model {

	//
    public function exercise()
    {
        return $this->hasOne('App\Exercise', 'id','exercise_id');
    }

}
