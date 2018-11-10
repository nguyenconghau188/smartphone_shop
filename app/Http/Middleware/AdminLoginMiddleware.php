<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->active == 0)
            {
                return redirect('admin/login')->with('fail', 'Tài khoản chưa được kích hoạt!');
            }
            return $next($request);
        }
        else
        {
            return redirect('admin/login');
        }
    }
}
