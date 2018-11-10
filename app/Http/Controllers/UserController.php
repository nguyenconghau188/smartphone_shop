<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function listUser()
    {
    	$users = User::all();
    	return view('admin.users.list', ['users'=>$users]);
    }

    public function getAdd()
    {
    	return view('admin.users.add');
    }

    public function postAdd(Request $request)
    {
    	$this->validate($request, 
    		[
    			'username'=>'required|unique:users,username',
    			'password'=>'required',
    			'email'=>'required|email|unique:users,email'
    		],
    		[
    			'username.required'=>'chưa nhập tên đăng nhập',
    			'username.unique'=>'Tên đăng nhập đã tồn tại',
    			'password.required'=>'Chưa nhập mật khẩu',
    			'email.required'=>'Chưa nhập địa chỉ email',
    			'email.email'=>'Vui lòng nhập đúng địa chỉ email',
    			'email.unique'=>'Địa chỉ mail đã được sử dụng'
    		]);

    	$user = new User;
    	$user->username = $request->username;
    	$user->password = bcrypt($request->password);
    	$user->email = $request->email;
    	$user->permission = 'admin';
    	$user->save();

    	return redirect('admin/users/add')->with('notification', 'Thêm thành công!');
    }

    public function getEdit($id)
    {
    	$user = User::find($id);
    	return view('admin.users.edit', ['user'=>$user]);
    }

    public function postEdit(Request $request, $id)
    {
    	$user = User::find($id);
    	$this->validate($request, 
    		[
    			'username'=>'required|unique:users,username,'.$user->id,
    			'email'=>'required|email|unique:users,email,'.$user->id,
    			'permission'=>'required'
    		],
    		[
    			'username.required'=>'chưa nhập tên đăng nhập',
    			'username.unique'=>'Tên đăng nhập đã tồn tại',
    			'email.required'=>'Chưa nhập địa chỉ email',
    			'email.email'=>'Vui lòng nhập đúng địa chỉ email',
    			'email.unique'=>'Địa chỉ mail đã được sử dụng',
    			'permission.required'=>'Chưa nhập quyền'
    		]);
    	if ($request->changePassword == 1) {
    		$this->validate($request, 
    		[
    			'password'=>'required'
    		],
    		[
    			'password.required'=>'Chưa nhập mật khẩu mới'
    		]);
    		$user->password = bcrypt($request->password);
    		echo $request->password;
    	}
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->permission = $request->permission;
    	$user->save();
    	return redirect('admin/users/edit/'.$request->id)->with('notification', 'Sửa thành công!');
    }

    public function getDelete($id)
    {
    	$user = User::find($id);
    	$user->delete();
    	return redirect('admin/users/list')->with('notification', 'Xóa thành công!');
    }

}
