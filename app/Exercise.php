<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model {

	public function exerciseType()
    {
        return $this->hasOne('App\ExerciseType', 'id' ,'exercise_type_id');
    }
}
