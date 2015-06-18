<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use Auth;
use Config;

use App\User;
use App\Role;


class AdminComposer {
    protected $users;

    public function __construct()
    {

    }

    public function compose(View $view)
    {

        if (null !== Auth::user()) {

            $routes = $this->getMyRoutes();
            $menu = $this->getMenu($routes);

            $view->with('menus',$menu);
        }

    }

    /**
     * @param $roles
     * @param $available
     */
    public function getMyRoutes()
    {
        $user = Auth::user();
        $roles = $user->roles;
        $available = array();
        foreach ($roles as $role) {
            $routes = $role->RoleRoutes;
            foreach ($routes as $route) {
                if ($route->method == "GET") $available[$route->route] = 1;
            }
        }

        return $available;
    }

    /**
     * @param $routes
     * @param $menus
     * @return array
     */
    public function getMenu($routes)
    {
        $menus= Config::get("adminLinks.links");
        $menu = array();
        foreach ($routes as $route => $value) {
            if (array_key_exists($route, $menus)) {
                $menu[$route] = $menus[$route];
            }
        }
        return $menu;
    }

}