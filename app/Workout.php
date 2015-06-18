<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model {

	public function workoutExercises()
    {
        return $this->hasMany('App\WorkoutExercise');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
