<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ("{$user->role->id}" !== $role) {
            $prefix = "";
            if($user->role->id === 1) {
                $prefix = "admins.";
            } else if($user->role->id === 2) {
                $prefix = "moderators.";
            } else if($user->role->id === 3) {
                $prefix = "volunteers.";
            } else {
                $prefix = "";
            }

            return redirect()->route($prefix.'index');
        }

        return $next($request);
    }
}
