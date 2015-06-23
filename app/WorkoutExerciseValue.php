<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkoutExerciseValue extends Model {

	//
    public function InternalType()
    {
        return $this->hasOne('App\InternalType','id', 'internal_type_id');
    }
}
