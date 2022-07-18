<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
{
    public function handle($request, Closure $next, $routeRoles)
    {
        $nameArray = explode('|', $routeRoles);

        if (Auth::check() == false) {
            return redirect()->guest('login');
        }

        $auth = auth()->id();
        $data = auth()->user()->dataRole($auth);

        if (!in_array($data, $nameArray)) {
            abort(401,'NO PERMISSION');
        }

        $request->session()->put('role_name', $data);
        return $next($request);
    }
}
