<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isDosen
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!auth()->check() || auth()->user()->role !== 'dosen' && auth()->user()->role !== 'admin' && auth()->user()->role !== 'superadmin' ){
        //     abort(403);
        // }

        $checkUser = !auth()->check() || auth()->user()->role;
        if($checkUser !== 'dosen' || $checkUser !== 'admin' || $checkUser !== 'superadmin') {
            abort(403);
        }
      
        return $next($request);
    }
}
