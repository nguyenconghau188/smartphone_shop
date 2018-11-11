<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use View;


class CheckLogin
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
            if (Auth::guard('customers')->user()->active == 1) {
                $this->login();
                return $next($request);
            }
            else {
                return redirect('login')->with('fail', 'Tài khoản này chưa được kích hoạt');
            }
        }
        else {
            return redirect('login')->with('fail', 'Bạn phải đăng nhập để thực hiện chức năng này');
        }
    }

    function login()
    {
        if (Auth::guard('customers')->check()) {
            view()->share('customer_login', Auth::guard('customers')->user());
        }
    }
}
