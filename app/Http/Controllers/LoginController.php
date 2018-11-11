<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;


class LoginController extends Controller
{
    public function getLogin()
    {
    	return view('login');
    }

    public function postLogin(Request $request)
    {
    	$this->validate($request, 
            [
                'username'=>'required',
                'password'=>'required'
            ], 
            [
                'username.required'=>'Chưa nhập tên đăng nhập',
                'password.required'=>'Chưa nhập mật khẩu'
            ]);

        $dataAttemp = array(
    			'username'=>$request->username,
    			'password'=>$request->password
    		);
        if (Auth::guard('customers')->check()) {
        	Auth::guard('customers')->logout();
        }
    	if (Auth::guard('customers')->attempt($dataAttemp)) {
    		if (Auth::guard('customers')->user()->permission == "admin" || Auth::guard('customers')->user()->permission == "systemAdmin") {
    			return redirect('admin/products/list');
    		}
    		else
    		{
    			return redirect('pages/home');
    		}
        }
        else {
            return redirect('login')->with('fail', 'Tên đăng nhập hoặc mật khẩu không đúng!');
        }
    }

    public function getLogout()
    {
    	if (Auth::guard('customers')->check()) {
        	Auth::guard('customers')->logout();
        }
    	return redirect('login');
    }
}
