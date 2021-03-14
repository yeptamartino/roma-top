<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Constants;

class SuperAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if(!Auth::guard($guard)->check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        if($user->role !== Constants::$USER_ROLE_SUPER_ADMIN) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
