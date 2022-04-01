<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isDosen
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
        $checkUser = !auth()->check() || auth()->user()->user_type;
        if($checkUser !== 'Dosen' || $checkUser !== 'Admin' || $checkUser !== 'SuperAdmin') {
            abort(403);
        }
        return $next($request);
    }
}
