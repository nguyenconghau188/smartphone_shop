<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;


class ProductController extends Controller
{
    public function listProduct()
    {
    	$products = Product::all();
    	return view('admin.products.list', ['products'=>$products]); 
    }
}
