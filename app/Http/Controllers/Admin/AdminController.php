<?php namespace App\Http\Controllers\Admin;


// Facades
use Auth;
use Validator;
use Input;
use Form;
use Request;

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

    public function getExercisetypes($id = null, $editType = null)
    {
        if (null == $id) {
            return view("admin.exerciseTypes")->with("types", ExerciseType::all())->with("internalTypes", InternalType::lists("name", "id"));
        } else {
            $type = ExerciseType::find($id);
            if ("edit" == $editType) {
                return view("admin.editModal")
                    ->with("type", "Edit")
                    ->with("title", "Exercise Types")
                    ->with("target", url("/admin/exercisetypes"))
                    ->with("hiddens", array("id" => $type->id, "type" => "edit"))
                    ->with("elements", array('Exercise Type' => Form::text('name', $type->name, array('class' => 'form-control')))
                    );
            } elseif ("delete"==$editType)
            {
                return view("admin.editModal")
                    ->with("type", "Delete")
                    ->with("title", "Exercise Types")
                    ->with("target", url("/admin/exercisetypes"))
                    ->with("hiddens", array("id" => $type->id, "type" => "delete"))
                    ->with("elements", array('Exercise Type' => Form::text('name', $type->name, array('class' => 'form-control', 'disabled'=>'')))
                    );
            }
        }
    }

    public function postExercisetypes()
    {
        if (null == Input::get("id")) {
            $v = Validator::make(Input::all(), [
                'name' => 'required|unique:exercise_types|min:5|max:255|string',
            ],[
                'name.required' => 'The Exercise Types field is required.',
                'name.unique'   => 'This exercise type is already in the database.',
                'name.min'      => 'The Exercise Type should be between 5 and 255 characters'
            ]);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
            $type = new ExerciseType();
            $type->name = Input::get("name");
            $type->internal_type_id = Input::get("internal_id");
            $type->save();
            return redirect("admin/exercisetypes")->withInput(Input::all());
        }
        elseif ("delete" == Input::get("type"))
        {
            ExerciseType::find(Input::get("id"))->delete();
            redirect("admin/exercisetypes");
        }
        elseif ("edit" == Input::get("type"))
        {
            $type = ExerciseType::find(Input::get("id"));
            $type->name = Input::get("name");
            $type->save();
            redirect("admin/exercisetypes");
        }
        return redirect("admin/exercisetypes")->withInput(Input::all());
    }

    public function getExercises($id = null, $editType = null)
    {
        if (null == $id) {
            return view("admin.exercises")->with("exercises", Exercise::all())->with("formTypes", ExerciseType::lists("name", "id"))->with("types", ExerciseType::all());
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
                'name.required' => 'The Exercise field is required.',
                'name.unique'   => 'This exercise is already in the database.',
                'name.min'      => 'The Exercise should be between 5 and 255 characters'
            ]);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
            $type = new Exercise();
            $type->name = Input::get("name");
            $type->exercise_type_id = Input::get("exercise_type_id");
            $type->save();
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
}


