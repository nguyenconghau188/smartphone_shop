<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        if (Auth::guard('customers')->check()) {
            if (Auth::guard('customers')->user()->permission == "systemAdmin" || Auth::guard('customers')->user()->permission == "admin" ) {
                if (Auth::guard('customers')->user()->active == 1) {
                    return $next($request);
                }
                else {
                    return redirect('login')->with('fail', 'Tài khoản chưa được kích hoạt');
                }
            }
            else {
                return redirect('login')->with('fail', 'Bạn không có quyền để thực hiện chức năng này');
            }
        }
    }
}
