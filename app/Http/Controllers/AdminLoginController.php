<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class AdminLoginController extends Controller
{
    public function getLogin()
    {
        return view('admin.login');
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
    	if (Auth::attempt($dataAttemp)) {
            return redirect('admin/products/list');
        }
        else {
            return redirect('admin_login')->with('fail', 'Tên đăng nhập hoặc mật khẩu không đúng!');
        }
    }

    public function getLogout()
    {
    	if (Auth::check()) {
    		Auth::logout();
    	}
    	return redirect('admin/login');
    }
}
