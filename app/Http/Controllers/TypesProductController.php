<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeProduct;


class TypesProductController extends Controller
{
    public function listTypesProduct()
    {
    	$types = TypeProduct::all();
    	//var_dump($manu);
    	return view('admin.types_product.list', ['types'=>$types]);
    }

    public function getAdd()
    {
    	return view('admin.types_product.add');
    }

    public function postAdd(Request $request)
    {
    	$this->validate($request, 
    		[
    			'name'=>'required|unique:type_products,name',
    			'price_range'=>'required'
    		],
    		[
    			'name.required'=>'chưa nhập phân khúc điện thoại',
    			'name.unique'=>'Phân khúc điện thoại đã tồn tại',
    			'price_range.required'=>'Chưa nhập tầm giá'
    		]);

    	$type = new TypeProduct;
    	$type->name = $request->name;
    	$type->price_range = $request->price_range;
    	$type->save();

    	return redirect('admin/types_product/add')->with('notification', 'Thêm thành công!');
    }

    public function getEdit($id)
    {
    	$type = TypeProduct::find($id);
    	return view('admin.types_product.edit', ['type'=>$type]);
    }

    public function postEdit(Request $request, $id)
    {
    	$type = TypeProduct::find($id);
    	$this->validate($request, 
    		[
    			'name'=>'required|unique:type_products,name,'.$type->id,
    			'price_range'=>'required'
    		],
    		[
    			'name.required'=>'chưa nhập tên nhà sản xuất',
    			'name.unique'=>'Tên nhà sản xuất đã tồn tại',
    			'price_range.required'=>'Chưa nhập nơi xuất xứ'
    		]);
    	$type->name = $request->name;
    	$type->price_range = $request->price_range;
    	$type->save();
    	return redirect('admin/types_product/edit/'.$request->id)->with('notification', 'Sửa thành công!');
    }

    public function getDelete($id)
    {
    	$type = TypeProduct::find($id);
    	$type->delete();
    	return redirect('admin/types_product/list')->with('notification', 'Xóa thành công!');
    }
}
