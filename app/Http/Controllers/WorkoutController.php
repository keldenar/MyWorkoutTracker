<?php namespace App\Http\Controllers;


use App\ExerciseType;
use App\Workout;
use App\WorkoutExercise;
use App\User;
use Auth;
use Validator;
use Input;
use Carbon\Carbon;

class WorkoutController extends Controller
{

    public function __construct()
    {

    }

    public function index($link = null)
    {

    }

    public function getIndex()
    {
        if (true == Auth::check()) {
            return view('newWorkout')->with("user", Auth::user());
        }
    }

    public function postIndex()
    {
        $v = Validator::make(Input::all(), [
            'name' => 'required|min:5|max:255|string',
            'date' => 'required|date',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        $workout = new Workout();
        $workout->name = Input::get("name");
        $date = new \DateTime(Input::get("date"));
        $workout->workout_date = $date;
        $workout->user_id = Auth::user()->id;
        $workout->save();
        return redirect(url("/workout/edit/" . $workout->id));
    }

    public function getEdit($id = null)
    {
        if (null == $id) {
            return redirect(url("/"));
        } else {
            return view("workout")->with("workout", Workout::find($id))->with("exerciseTypes", ExerciseType::all());
        }
    }


    public function postEdit()
    {
        $workout = Workout::find(Input::get("id"));
        if (Auth::user()->id !== $workout->user_id) return;
    }

    public function getForm($id = null)
    {
        if (null == $id){
        } else {
            $types["0"] = "None";
            $selectTypes = ExerciseType::lists("name","id");
            foreach($selectTypes as $typeId => $name) {
                $types["$typeId"] = $name;
            }
            return view("exercise.new")->with("id", $id)->with("types",$types);
        }
    }

    public function getExerciseselect()
    {
        // Get the type_id array from the input
        $type_id = Input::get("type_id");

        //Reset the array to the begining
        reset($type_id);
        // Get the ID for this type element
        $id = key($type_id);

        $types = ExerciseType::find($type_id[$id]);

        $inputDesc = ucfirst($types->internalType->name);
        $exercises = $types->Exercises;
        return view("exercise.select")->with("exercises",$exercises)->with("inputDesc", $inputDesc)->with("id", $id);
    }

    private function decodeInputJSON($array)
    {
        $return = array();
        foreach($array as $json => $nill)
        {
            $tmp = json_decode($json);
            array_push($return, $tmp);
        }
        return $return;
    }

    public function postExercise()
    {
        $values = Input::get("value");
        $exercises = Input::get("exercise_id");
        $workout_id = Input::get("workout_id");
        foreach($values as $id => $value) {
            $we = new WorkoutExercise();
            $we->workout_id = $workout_id;
            $we->value = $value;
            $we->exercise_id = $exercises[$id];
            $we->save();
        }
        return redirect()->back();
    }
}

