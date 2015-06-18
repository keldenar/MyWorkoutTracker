<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseType extends Model {

    public function internalType()
    {
        return $this->hasOne('App\InternalType', 'id', 'internal_type_id');
    }

    public function Exercises()
    {
        return $this->hasMany('App\Exercise', 'exercise_type_id');
    }

}
