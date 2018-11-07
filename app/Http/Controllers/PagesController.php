<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Manufactory;
use App\TypeProduct;


class PagesController extends Controller
{
    public function homePage()
    {
    	$products = Product::orderBy('unit_price', 'desc')->take(6)->get();
    	return view('client.pages.home', ['products'=>$products]); 
    }

    public function advandceProduct()
    {
    	$products = Product::where('id_type', 5)->orderBy('created_at', 'desc')->paginate(12);
    	return view('client.pages.advandce_product', ['products'=>$products]); 
    }
}
