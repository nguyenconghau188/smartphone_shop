<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Manufactory;
use App\TypeProduct;
use App\Customer;


class PagesController extends Controller
{
    public function homePage()
    {
    	$products = Product::orderBy('unit_price', 'desc')->take(6)->get();
    	return view('client.pages.home', ['products'=>$products]); 
    }

    public function productDetail($id)
    {
    	$product = Product::find($id);
    	$relateProducts = Product::where('id_type', $product->id_type)->orderBy('created_at', 'desc')->take(6)->get();
    	return view('client.pages.product', ['product'=>$product, 'relateProducts'=>$relateProducts]);
    }

    public function advandceProduct()
    {
    	$products = Product::where('id_type', 5)->orderBy('created_at', 'desc')->paginate(12);
    	return view('client.pages.advandce_product', ['products'=>$products]); 
    }

    public function nearadvProduct()
    {
    	$products = Product::where('id_type', 3)->orderBy('created_at', 'desc')->paginate(12);
    	return view('client.pages.nearadv_product', ['products'=>$products]); 
    }

    public function normalProduct()
    {
    	$products = Product::where('id_type', 2)->orderBy('created_at', 'desc')->paginate(12);
    	return view('client.pages.normal_product', ['products'=>$products]); 
    }

    public function basicProduct()
    {
    	$products = Product::where('id_type', 1)->orderBy('created_at', 'desc')->paginate(12);
    	return view('client.pages.basic_product', ['products'=>$products]); 
    }

    public function getCustomerProfile($id)
    {
        $customer = Customer::find($id);
    	// var_dump($customer);
    	// echo 'time: '.strtotime($customer->birthday);
    	return view('client.pages.customer_profile', ['customer'=>$customer]);
    }

    public function wishList()
    {
        return view('client.pages.wishlist');
    }

    public function news()
    {
        return view('client.pages.news');
    }

    public function contact()
    {
        return view('client.pages.contact');
    }
}
