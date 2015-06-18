<?php namespace App\Http\Middleware;

use Closure;
use App\RoleRoute;
use Auth;

class roleCheck {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $route = $request->Route()->getCompiled()->getStaticPrefix();
        $methods = $request->Route()->getMethods();
        $user = Auth::user();
        $roles = $user->roles();
        $protected = false;
        //dd($methods, $route);
        foreach ($methods as $method) {
            if (RoleRoute::where("route", "=", $route)->where("method", "=", $method)->count() > 0) {
                $protected = true;
            }
            $roleRoutes = RoleRoute::where("route", "=", $route)->where("method", "=", $method)->get();
            foreach ($roleRoutes as $roleRoute) {
                if ($roles->where("roles.id", "=", $roleRoute->role_id)->count() > 0) {
                    return $next($request);
                }
            }
        }
        if ($protected) {
            return redirect('home');
        } else {
            return $next($request);
        }
	}

}
