<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manufactory;


class ManufactoriesController extends Controller
{
    public function listManufactories()
    {
    	$manu = Manufactory::all();
    	//var_dump($manu);
    	return view('admin.manufactories.list', ['manufactories'=>$manu]);
    }

    public function getAdd()
    {
    	return view('admin.manufactories.add');
    }

    public function postAdd(Request $request)
    {
    	$this->validate($request, 
    		[
    			'name'=>'required|unique:manufactories,name',
    			'national'=>'required'
    		],
    		[
    			'name.required'=>'chưa nhập tên nhà sản xuất',
    			'name.unique'=>'Tên nhà sản xuất đã tồn tại',
    			'national.required'=>'Chưa nhập nơi xuất xứ'
    		]);

    	$manu = new Manufactory;
    	$manu->name = $request->name;
    	$manu->national = $request->national;
    	$manu->save();

    	return redirect('admin/manufactories/add')->with('notification', 'Thêm thành công!');
    }
}
