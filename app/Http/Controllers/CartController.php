<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use Cart;

class CartController extends Controller
{

    public function cart()
    {
    	if (Request::isMethod('post')) {
    		$this->data['title'] = 'myCart';
	    	$productId = Request::get('product_id');
	    	$product = Product::find($productId);
	    	$cartInfo = [
	    		'id' => $productId,
	    		'name' => $product->name,
	    		'price' => $product->promotion_price ? $product->promotion_price : $product->unit_price,
	    		'qty' => 1,
	    		'options' => ['image' => $product->image, ],
	    	];
	    	Cart::add($cartInfo);
    	}

    	$cart = Cart::content();
    	return redirect('pages/cart_detail');
    }

    public function cartDetail()
	{
		$cart = Cart::content() ? Cart::content() : null;
		return view('client.pages.cart_detail', ['cart'=>$cart]);
	}

    public function quantitySub($id)
    {
    	$productId = $id;
    	$row = Cart::search(function($key, $value) use($productId){
    			return $key->id == $productId;
    		});
    	$item = $row->first();
    	Cart::update($item->rowId, $item->qty - 1);

    	return redirect('pages/cart_detail');
    }

    public function quantityAdd($id)
    {
    	$productId = $id;
    	$row = Cart::search(function($cartItem, $rowId) use($productId){
    			return $cartItem->id === $productId;
    		});
    	$item = $row->first();
    	Cart::update($item->rowId, $item->qty + 1);

    	return redirect('pages/cart_detail');
    }

    public function deleteCart()
    {
    	Cart::destroy();	
    }
}
