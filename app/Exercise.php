<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model {

	public function exerciseCategory()
    {
        return $this->hasOne('App\ExerciseCategory', 'id' ,'exercise_category_id');
    }

    public function exerciseValueTypes()
    {
        return $this->hasMany('App\ExerciseValueType','exercise_id','id');
    }
}
