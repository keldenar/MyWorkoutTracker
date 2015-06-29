<?php namespace App\Http\Controllers\Admin;


// Facades
use App\ExerciseCategory;
use App\ExerciseValueType;
use Auth;
use Validator;
use Input;
use Form;
use Request;
use roleCheck;

//Models
use App\Role;
use App\RoleRoute;
use App\User;
use App\UserRole;
use App\ExerciseType;
use App\InternalType;
use App\Exercise;


// Illuminate
use Illuminate\Support\MessageBag as MessageBag;

// Controller
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roleCheck');
    }

    public function getIndex()
    {
        return view("admin.admin")->with("user", Auth::user());
    }

    public function postUserroles()
    {
        if (null !== Input::get("delete")) {
            UserRole::where("user_id", "=", Input::get("user_id"))->where("role_id","=",Input::get("role_id"))->delete();
        } else {
            $v = Validator::make(Input::all(), [
                'user_name' => 'required|min:3|max:255|string',
            ]);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
            // Validation is good so get the user
            $user = User::where("link", "=", Input::get("user_name"))->first();
            if (null == $user) {
                $messages = new MessageBag;
                $messages->add('user_name', "The username was not found.");
                return redirect()->back()->withErrors($messages)->withInput();
            }
            $role = Role::find(Input::get("role_id"));
            try
            {
                $user->roles()->save($role);
            }
            catch(\exception $e)
            {
                $messages = new MessageBag;
                $messages->add('user_name', "There was an error adding this role to the user.");
                return redirect()->back()->withErrors($messages)->withInput();
            }
        }

        return redirect("admin/userroles")->withInput(Input::all());
    }

    public function getUserroles()
    {
        $role = Role::all();
        return view("admin.userRoles")->with("roles", $role);
    }

    public function getRoleroutes()
    {
        $role = Role::all();
        return view("admin.roleRoutes")->with("roles", $role);
    }

    public function postRoleroutes()
    {
        $role = Role::all();
        if (null !== Input::get("delete")) {
            RoleRoute::find(Input::get("id"))->delete();
            return view("admin.roleRoutes")->with("roles", $role);
        }
        $route = new RoleRoute;
        $route->role_id=Input::get("id");
        $route->method=Input::get("method");
        $route->route=Input::get("route");
        $route->save();
        return view("admin.roleRoutes")->with("roles", $role);
    }

    public function getRoles()
    {
        $role = Role::all();
        return view("admin.roles")->with("roles", $role);
    }

    public function postRoles()
    {

        if (null !== Input::get("delete")) {
            $this->removeRoles(Input::get("id"));
        } else {
            $v = Validator::make(Input::all(), [
                'name' => 'required|unique:roles|min:5|max:255|string',
                'description' => 'required|max:255'
            ]);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }

            $role = new Role;
            $role->name = Input::get("name");
            $role->description = Input::get("description");
            $role->save();
        }
        $role = Role::all();
        return view("admin.roles")->with("roles", $role);
    }

    public function getExercisecategories($id = null, $editType = null)
    {
        if (null == $id) {
            return view("admin.exerciseCategories")->with("categories", ExerciseCategory::all());
        } else {
            $category = ExerciseCategory::find($id);
            if ("edit" == $editType) {
                return view("admin.editModal")
                    ->with("type", "Edit")
                    ->with("title", "Exercise Categories")
                    ->with("target", url("/admin/exercisecategories"))
                    ->with("hiddens", array("id" => $category->id, "type" => "edit"))
                    ->with("elements", array('Exercise Category' => Form::text('name', $category->name, array('class' => 'form-control')))
                    );
            } elseif ("delete"==$editType)
            {
                return view("admin.editModal")
                    ->with("type", "Delete")
                    ->with("title", "Exercise Categories")
                    ->with("target", url("/admin/exercisecategories"))
                    ->with("hiddens", array("id" => $category->id, "type" => "delete"))
                    ->with("elements", array('Exercise Category' => Form::text('name', $category->name, array('class' => 'form-control', 'disabled'=>'')))
                    );
            }
        }
    }

    public function postExercisecategories()
    {
        if (null == Input::get("id")) {
            $v = Validator::make(Input::all(), [
                'name' => 'required|unique:exercise_categories|min:4|max:255|string',
            ],[
                'name.required' => 'The Exercise Category field is required.',
                'name.min'      => 'The Exercise Category should be between 4 and 255 characters'
            ]);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
            $category = new ExerciseCategory();
            $category->name = Input::get("name");
            // TODO add description / links to the form.
            $category->description = "";
            $category->link = "";

            $category->save();
            return redirect("admin/exercisecategories")->withInput(Input::all());
        }
        elseif ("delete" == Input::get("type"))
        {
            ExerciseCategory::find(Input::get("id"))->delete();
            redirect("admin/exercisecategories");
        }
        elseif ("edit" == Input::get("type"))
        {
            $category = ExerciseCategory::find(Input::get("id"));
            $category->name = Input::get("name");

            $category->save();
            redirect("admin/exercisecategories");
        }
        return redirect("admin/exercisecategories")->withInput(Input::all());
    }

    public function getExercises($id = null, $editType = null)
    {
        if (null == $id) {
            return view("admin.exercises")->with("exercises", Exercise::all())->with("categories", ExerciseCategory::all())->with("internalType", InternalType::all());
        } else {
            $exercise = Exercise::find($id);
            return $this->getModal($editType, $exercise, 'Exercise', url("/admin/exercises"));
        }
    }

    public function postExercises()
    {
        if (null == Input::get("id")) {
            $v = Validator::make(Input::all(), [
                'name' => 'required|unique:exercises|min:5|max:255|string',
            ],[
                'name.required' => 'The exercise field is required.',
                'name.unique'   => 'This exercise is already in the database.',
                'name.min'      => 'The exercise should be between 5 and 255 characters'
            ]);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
            $exercise = new Exercise();
            $exercise->name = Input::get("name");
            $exercise->exercise_category_id = Input::get("exercise_category_id");
            $exercise->description = "";
            $exercise->link = "";
            $exercise->video_link = "";
            $exercise->save();
            foreach(Input::get("internal_type_id") as $type_id) {
                $type = new ExerciseValueType;
                $type->exercise_id = $exercise->id;
                $type->internal_type_id = $type_id;
                $type->save();
            }
            return redirect("admin/exercises")->withInput(Input::all());
        }
        elseif ("delete" == Input::get("type"))
        {
            Exercise::find(Input::get("id"))->delete();
            redirect("admin/exercises");
        }
        elseif ("edit" == Input::get("type"))
        {
            $type = Exercise::find(Input::get("id"));
            $type->name = Input::get("name");
            $type->save();
            redirect("admin/exercises");
        }
        return redirect("admin/exercises")->withInput(Input::all());
    }

    private function removeRoles()
    {
        $role = Role::find(Input::get("id"));
        $role->delete();
    }

    public function getModal($editType, $type, $title, $url)
    {
        return view("admin.editModal")
            ->with("type", ucfirst($editType))
            ->with("title", $title)
            ->with("target", $url)
            ->with("hiddens", array("id" => $type->id, "type" => $editType))
            ->with("elements", array($title => Form::text('name', $type->name, array('class' => 'form-control')))
            );

    }

    public function getInternaltypes($id = null, $editType=null)
    {
        if (null == $id) {
            return view("admin.internalTypes")->with("internalType", InternalType::all());
        } else {
            $internalType = InternalType::find($id);
            return $this->getModal($editType, $internalType, 'Internal Type', url("/admin/internaltypes"));
        }
    }

    public function postInternaltypes()
    {
        if (null == Input::get("id")) {
            $v = Validator::make(Input::all(), [
                'name' => 'required|unique:internal_types|min:5|max:255|string',
            ],[
                'name.required' => 'The Internal Type field is required.',
                'name.min'      => 'The Internal Type should be between 5 and 255 characters'
            ]);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
            $type = new InternalType();
            $type->name = Input::get("name");

            $type->save();
            return redirect("admin/internaltypes")->withInput(Input::all());
        }
        elseif ("delete" == Input::get("type"))
        {
            InternalType::find(Input::get("id"))->delete();
            redirect("admin/internaltypes");
        }
        elseif ("edit" == Input::get("type"))
        {
            $type = InternalType::find(Input::get("id"));
            $type->name = Input::get("name");

            $type->save();
            redirect("admin/internaltypes");
        }
        return redirect("admin/internaltypes")->withInput(Input::all());
    }

}


