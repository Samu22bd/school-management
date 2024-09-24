<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminOrTeacherOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // hanya admin (role_id = 1) dan teacher (role_id = 2) yang bisa melewati middleware
        if(Auth::user()->role_id != 1 && Auth::user()->role_id != 2){
            abort(404);
        }

        return $next($request);
    }
}
