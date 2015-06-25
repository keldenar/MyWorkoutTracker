<?php namespace App\Http\Controllers;


use App\Exercise;
use App\ExerciseCategory;
use App\ExerciseType;
use App\ExerciseValueType;
use App\Workout;
use App\WorkoutExercise;
use App\User;
use App\WorkoutExerciseValue;
use Auth;
use Validator;
use Input;
use Carbon\Carbon;
use Form;

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
            return view("workout")->with("workout", Workout::find($id));
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
            $categories["0"] = "None";
            $selectCategories = ExerciseCategory::lists("name","id");
            foreach($selectCategories as $categoryId => $name) {
                $categories["$categoryId"] = $name;
            }
            return view("exercise.new")->with("id", $id)->with("categories",$categories);
        }
    }

    public function getExerciseselect()
    {
        $category_id = Input::get("exercise_category_id");
        reset($category_id);
        $id = key($category_id);

        $category = ExerciseCategory::find($category_id[$id]);
        if (null == $category) {
            return view("exercise.select")->with("exercises",null)->with("id", $id);
        }
        $exercises = $category->Exercises->sortBy("name")->lists("name","id");;
        $selectExercises["0"] = "None";
        foreach($exercises as $exerciseId => $name) {
            $selectExercises["$exerciseId"] = $name;
        }

        return view("exercise.select")->with("exercises",$selectExercises)->with("id", $id);
    }

    public function getExercisevalues()
    {
        $exercise_id = Input::get("exercise_id");
        reset($exercise_id);
        $id = key($exercise_id);
        $fields = ExerciseValueType::where("exercise_id","=",$exercise_id[$id])->get();
        if ($fields->isEmpty()) {
            return view("exercise.value")->with("id", $id)->with("fields", null);
        }
        return view("exercise.value")->with("id", $id)->with("fields", $fields);
    }

    public function postExercise()
    {

        $values = Input::get("value_id");
        $exercises = Input::get("exercise_id");
        $workout_id = Input::get("workout_id");
        $workout = Workout::find($workout_id);
        if ($workout->user_id !== Auth::user()->id) {
            return redirect()->back();
        }
        foreach($values as $id => $value) {
            $we = new WorkoutExercise();
            $we->workout_id = $workout_id;
            $we->exercise_id = $exercises[$id];
            $we->save();

            $exercise = Exercise::find($exercises[$id]);
            $exercise_value_types = $exercise->exerciseValueTypes->sortBy("id");
            foreach($exercise_value_types as $index => $value_type) {
                $wv = new WorkoutExerciseValue();
                $wv->workout_exercise_id = $we->id;
                $wv->internal_type_id = $value_type->internal_type_id;
                $wv->value = $value[$index];
                $wv->save();

            }
        }
        return redirect()->back();
    }

    public function getDelete($id) {
        $workout = Workout::find($id);
        if ($workout->user_id !== Auth::user()->id) {
            return;
        } else {
            return view("exercise.delete")->with("id",$id)->with("workout", $workout);
        }
    }

    public function postDelete()
    {
        $id = Input::get("id");
        $workout = Workout::find($id);
        $user = $workout->user;

        if ($workout->user_id == Auth::user()->id) {
            $workout->delete();
        }

        return redirect("/user/" . $user->link);
    }

    public function getEditexercise($id = null)
    {
        $workoutExercise = WorkoutExercise::find($id);
        if ($workoutExercise->workout->user_id !== Auth::user()->id)
            abort(403, 'Unauthorized action.');;
        $elements["Exercise"] = "<span class='form-control form-control-flat'>" . $workoutExercise->exercise->name . "</span>";
        foreach($workoutExercise->workoutValues as $workoutValue) {
            $elements[$workoutValue->InternalType->name] = Form::text("val[" . $workoutValue->id ."]", $workoutValue->value, array("class" => "form-control"));
        }

        return view("exercise.editModal")
            ->with("type", "Edit")
            ->with("title", "Exercise")
            ->with("target", url("/workout/editexercise"))
            ->with("hiddens", array("id" => $id))
            ->with("elements", $elements)
            ->with("id",$id);
    }


    public function postEditexercise()
    {
        $id = Input::get("id");
        $workoutExercise = WorkoutExercise::find($id);
        if ($workoutExercise->workout->user_id !== Auth::user()->id) abort(403, 'Unauthorized action.');
        foreach(Input::get("val") as $workoutValueId=>$value) {
            $workoutValue = WorkoutExerciseValue::find($workoutValueId);
            $workoutValue->value = $value;
            $workoutValue->save();
        }
        return view("exercise.editResponse")->with("workoutExercise", $workoutExercise);
    }

    public function getDeleteexercise($id)
    {
        $workoutExercise = WorkoutExercise::find($id);
        if ($workoutExercise->workout->user_id !== Auth::user()->id)
            abort(403, 'Unauthorized action.');;
        $elements["Exercise"] = "<span class='form-control form-control-flat'>" . $workoutExercise->exercise->name . "</span>";
        foreach($workoutExercise->workoutValues as $workoutValue) {
            $elements[$workoutValue->InternalType->name] = "<span class='form-control form-control-flat'>" . $workoutValue->value . "</span>";
        }

        return view("exercise.deleteModal")
            ->with("type", "Delete")
            ->with("title", "Exercise")
            ->with("target", url("/workout/deleteexercise"))
            ->with("hiddens", array("id" => $id))
            ->with("elements", $elements)
            ->with("id",$id);
    }

    public function postDeleteexercise()
    {
        $id = Input::get("id");
        $workoutExercise = WorkoutExercise::find($id);
        if ($workoutExercise->workout->user_id !== Auth::user()->id) abort(403, 'Unauthorized action.');
        $workoutExercise->delete();
        return;
    }

    public function getClone($id)
    {
        if (false == Auth::check()) {
            abort(403, 'Unauthorized action.');
        }
        return view("exercise.cloneModal")->with("workout", Workout::find($id));
    }

    public function postClone() {
        if (false == Auth::check()) {
            abort(403, 'Unauthorized action.');
        }
        $workout = Workout::find(Input::get("id"));
        $new = new Workout();
        $new->name = $workout->name;
        $new->workout_date = date('Y-m-d H:i:s');
        $new->user_id = Auth::user()->id;
        $new->save();
        foreach($workout->workoutExercises as $exercise) {
            $ne = new WorkoutExercise;
            $ne->workout_id = $new->id;
            $ne->exercise_id = $exercise->exercise_id;
            $ne->save();
            foreach($exercise->workoutValues as $value) {
                $wv = new WorkoutExerciseValue;
                $wv->workout_exercise_id = $ne->id;
                $wv->internal_type_id = $value->internal_type_id;
                $wv->value = $value->value;
                $wv->save();
            }
        }
        return redirect()->back();
    }
}

