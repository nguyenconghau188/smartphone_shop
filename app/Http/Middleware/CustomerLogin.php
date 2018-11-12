<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerLogin
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
            if (Auth::guard('customers')->user()->permission == 'customer') {
                if (Auth::guard('customers')->user()->active == 1) {
                    return $next($request);
                }
                else {
                    return redirect('login')->with('fail', 'Tài khoản chưa được kích hoạt!');
                }
            }
            else {
                return redirect('login')->with('fail', 'Bạn không có quyền thực hiện chức năng này, vui lòng đăng nhập bằng tài khoản khác!');
            }
            
        }
        else {
             return redirect('login')->with('fail', 'Vui lòng đăng nhập để thực hiện chức năng này!');
        }
    }
}
