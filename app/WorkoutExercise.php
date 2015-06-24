<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model {

	//
    public function exercise()
    {
        return $this->hasOne('App\Exercise', 'id','exercise_id');
    }

    public function workoutValues()
    {
        return $this->hasMany('App\WorkoutExerciseValue','workout_exercise_id','id');
    }

    public function workout()
    {
        return $this->hasOne('App\Workout', 'id', 'workout_id');
    }

}
