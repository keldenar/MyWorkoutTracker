<?php namespace App\Http\Controllers;


use Auth;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {

    }

    public function index($link = null)
    {
        // if $username is null make them authenticate.
        if (null == $link)
        {
            if (false == Auth::check())
            {
                return redirect()->guest('auth/login');
            }
            return view('user')->with("user", Auth::user())->with("workouts", Auth::user()->workouts);
        } else {
            $user = User::where("link", "=", $link)->first();
            if (null == $user) {
                return view('user')->with("user", null)->with("workout", null);
            } else {
                return view('user')->with("user", $user)->with("workouts", $user->workouts);
            }
        }
    }
}

