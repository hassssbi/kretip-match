<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CheckBlacklist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        // var_dump($user);
        // var_dump($user->isBlacklisted());
        // var_dump($user->blacklist_end_date);
        // var_dump(Carbon::now());
        // die();
        if ($user && $user->isBlacklisted() && $user->blacklist_end_date > Carbon::now()) {
            // return redirect()->route('volunteers.blacklist.notice');
        }

        return $next($request);
    }
}
