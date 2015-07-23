<?php namespace App\Http\Controllers;


use App\ExerciseCategory;
use App\ExerciseSuggestion;

use App\InternalType;
use Validator;
use Input;
use Form;

class SuggestionController extends Controller
{

    public function __construct()
    {

    }

    public function getExercise()
    {
        return view("suggest.exerciseModal")->with('internalType' , InternalType::all())->with("categories", ExerciseCategory::all());
    }

    public function postExercise()
    {
        $v = Validator::make(Input::all(), [
            'name' => 'required|unique:exercises|min:4|max:255|string|unique:exercise_suggestions',
        ],[
            'name.required' => 'Error: The Exercise field is required.',
            'name.min'      => 'Error: The Exercise should be between 4 and 255 characters',
            'name.unique'   => 'Error: This exercise already exists or is in the request queue.'
        ]);
        if ($v->fails()) {
            Input::flash();
            return view("suggest.exerciseModal")->with("errors", $v->errors())->with('internalType' , InternalType::all())->with("categories", ExerciseCategory::all());
        }
        $exercise = new ExerciseSuggestion();
        $exercise->name = Input::get("name");
        $exercise->description = Input::get("description");
        $exercise->link = Input::get("link");
        $exercise->video_link = Input::get("video_link");
        $exercise->exercise_category_id = Input::get("exercise_category_id");
        $exercise->save();
        return view("suggest.thankyouModal");
    }

    public function getCategory()
    {
        return view("suggest.categoryModal");
    }


}

