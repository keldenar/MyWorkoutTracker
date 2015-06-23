<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseValueType extends Model {

	//
    public function internalType()
    {
        return $this->hasOne('App\InternalType','id','internal_type_id');
    }
}
