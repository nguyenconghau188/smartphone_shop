<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Manufactory;
use App\TypeProduct;


class ProductsController extends Controller
{
    public function listProduct()
    {
    	$products = Product::all();
    	return view('admin.products.list', ['products'=>$products]); 
    }

    public function getAdd()
    {
    	$types = TypeProduct::all();
    	$manus = Manufactory::all();

    	return view("admin.products.add", ['types'=>$types, 'manus'=>$manus]);
    }

    public function postAdd(Request $request)
    {
    	$this->validate($request, 
    		[
    			'name'=>'required|unique:products,name',
    			'id_type'=>'required',
    			'description'=>'required',
    			'unit_price'=>'required',
    			'image'=>'required',
    			'product_code'=>'required|unique:products,product_code',
    			'id_manufactory'=>'required'
    		], 
    		[
    			'name.required'=>'Vui lòng nhập tên sản phẩm',
    			'name.unique'=>'Tên sản phẩm đã tồn tại',
    			'id_type.required'=>'Vui lòng nhập phân khúc sản phẩm',
    			'description.required'=>'Vui lòng nhập mô tả sản phẩm',
    			'unit_price.required'=>'Vui lòng nhập giá sản phẩm',
    			'image.required'=>'Vui lòng thêm hình ảnh sản phẩm',
    			'product_code.required'=>'Vui lòng nhập mã sản phẩm',
    			'product_code.unique'=>'Mã sản phẩm này đã tồn tại',
    			'id_manufactory.required'=>'Vui lòng nhập nhà sản xuất'
    		]);

    	$product = new Product;
    	$product->name = $request->name;
    	$product->name_title = changeTitle($request->name);
    	$product->id_type = $request->id_type;
    	$product->description = $request->description;
    	$product->unit_price = $request->unit_price;
    	$product->promotion_price = $request->promotion_price ? $request->promotion_price : 0;
    	$product->product_code = $request->product_code;
    	$product->sell_quantity = 0;
    	$product->id_manufactory = $request->id_manufactory;

    	if ($request->hasFile('image')) 
    	{
    		$file = $request->image;
    		$format = $file->getClientOriginalExtension();
    		if ($format != 'jgp' && $format != 'jpeg' && $format != 'png') 
    		{
    			return redirect('admin/products/add')->with('fail', 'Chỉ nhấp nhận file ảnh .jpg, .jpeg, .png!');
    		}
    		$filename = $file->getClientOriginalName();
    		$image = str_random(4)."_".$filename;
    		while (file_exists("upload/image/".$image)) {
    		    $image = str_random(4)."_".$filename;
    		}
    		$file->move("upload/image", $image);
    		$product->image = $image;
    	}
    	var_dump($product);
    	$product->save();

    	return redirect('admin/products/add')->with('notification', "Thêm thành công!");
    }
}
