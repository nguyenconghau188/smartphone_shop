<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function listCustomer()
    {
    	$customers = Customer::all();
    	return view('admin.customers.list', ['customers'=>$customers]);
    }

    public function getAdd()
    {
    	return view('admin.customers.add');
    }

    public function postAdd(Request $request)
    {
    	$this->validate($request, 
    		[
    			'name'=>'required',
    			'gender'=>'required',
    			'address'=>'required',
    			'birthday'=>'required',
    			'phone_number'=>'required',
    			'permission'=>'required',
    			'active'=>'required',
    			'username'=>'required|unique:customers,username',
    			'password'=>'required',
    			'email'=>'required|email|unique:customers,email'
    		],
    		[
    			'username.required'=>'chưa nhập tên đăng nhập',
    			'username.unique'=>'Tên đăng nhập đã tồn tại',
    			'password.required'=>'Chưa nhập mật khẩu',
    			'email.required'=>'Chưa nhập địa chỉ email',
    			'email.email'=>'Vui lòng nhập đúng địa chỉ email',
    			'email.unique'=>'Địa chỉ mail đã được sử dụng',
    			'name.required'=>'chưa nhập họ tên',
    			'gender.required'=>'chưa nhập giới tính',
    			'address.required'=>'chưa nhập địa chỉ',
    			'birthday.required'=>'chưa nhập ngày sinh',
    			'phone_number.required'=>'chưa nhập số điện thoại',
    			'permission.required'=>'chưa phân quyền người dùng',
    			'active.required'=>'chưa nhập trạng thái người dùng',
    		]);

    	$customer = new Customer;
    	$customer->username = $request->username;
    	$customer->password = bcrypt($request->password);
    	$customer->name = $request->name;
    	$customer->gender = $request->gender;
    	$customer->birthday = $request->birthday;
    	$customer->email = $request->email;
    	$customer->address = $request->address;
    	$customer->phone_number = $request->phone_number;
    	$customer->permission = $request->permission;
    	$customer->active = $request->active;
    	$customer->note = $request->note ? $request->note : "";
    	$customer->save();

    	return redirect('admin/customers/add')->with('notification', 'Thêm thành công!');
    }

    public function getEdit($id)
    {
    	$customer = Customer::find($id);
    	// var_dump($customer);
    	// echo 'time: '.strtotime($customer->birthday);
    	return view('admin.customers.edit', ['customer'=>$customer]);
    }

    public function postEdit(Request $request, $id)
    {
    	$customer = Customer::find($id);
    	$this->validate($request, 
    		[
    			'name'=>'required',
    			'gender'=>'required',
    			'address'=>'required',
    			'birthday'=>'required',
    			'phone_number'=>'required',
    			'permission'=>'required',
    			'active'=>'required',
    			'username'=>'required|unique:customers,username,'.$customer->id,
    			'email'=>'required|email|unique:customers,email,'.$customer->id,
    		],
    		[
    			'username.required'=>'chưa nhập tên đăng nhập',
    			'username.unique'=>'Tên đăng nhập đã tồn tại',
    			'email.required'=>'Chưa nhập địa chỉ email',
    			'email.email'=>'Vui lòng nhập đúng địa chỉ email',
    			'email.unique'=>'Địa chỉ mail đã được sử dụng',
    			'name.required'=>'chưa nhập họ tên',
    			'gender.required'=>'chưa nhập giới tính',
    			'address.required'=>'chưa nhập địa chỉ',
    			'birthday.required'=>'chưa nhập ngày sinh',
    			'phone_number.required'=>'chưa nhập số điện thoại',
    			'permission.required'=>'chưa phân quyền người dùng',
    			'active.required'=>'chưa nhập trạng thái người dùng',
    		]);
    	if ($request->changePassword == 1) {
    		$this->validate($request, 
    		[
    			'password'=>'required'
    		],
    		[
    			'password.required'=>'Chưa nhập mật khẩu mới'
    		]);
    		$customer->password = bcrypt($request->password);
    		echo $request->password;
    	}
    	$customer->username = $request->username;
    	$customer->name = $request->name;
    	$customer->gender = $request->gender;
    	$customer->birthday = $request->birthday;
    	$customer->email = $request->email;
    	$customer->address = $request->address;
    	$customer->phone_number = $request->phone_number;
    	$customer->permission = $request->permission;
    	$customer->active = $request->active;
    	$customer->note = $request->note ? $request->note : "";
    	$customer->save();
    	return redirect('admin/customers/edit/'.$request->id)->with('notification', 'Sửa thành công!');
    }

    public function getDelete($id)
    {
    	$user = User::find($id);
    	$user->delete();
    	return redirect('admin/users/list')->with('notification', 'Xóa thành công!');
    }
}
