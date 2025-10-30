<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $roles = explode(',', $roles);
        if (!Auth::check()) {
            // Redirect them to the home page or show an error
            return Redirect::route('login');
        }

        return $next($request);
    }
}
