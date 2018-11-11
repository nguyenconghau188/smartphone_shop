<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use View;

class CheckCustomer
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
            $this->customerLogin();
        }
        return $next($request);
    }

    function customerLogin()
    {
        if(Auth::guard('customers')->check()){
            view()->share('customer_is_login', Auth::guard('customers')->user());
        }
    }
}
