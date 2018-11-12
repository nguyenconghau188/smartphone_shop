<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use Cart;
use App\Customer;
use App\Bill;
use App\BillDetail;
use Date;


class CartController extends Controller
{

    public function cart(Request $request)
    {

    		$this->data['title'] = 'myCart';
	    	$productId = $request->product_id;
	    	$product = Product::find($productId);
	    	$cartInfo = [
	    		'id' => $productId,
	    		'name' => $product->name,
	    		'price' => $product->promotion_price ? $product->promotion_price : $product->unit_price,
	    		'qty' => 1,
	    		'options' => ['image' => $product->image, ],
	    		];
	    	Cart::add($cartInfo);
    	

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

    public function removeItem($id)
    {
    	$productId = $id;
    	$row = Cart::search(function($cartItem, $rowId) use($productId){
    			return $cartItem->id === $productId;
    		});
    	$item = $row->first();
    	$rowId = $item->rowId;
    	Cart::remove($rowId);

    	return redirect('pages/cart_detail');
    }

    public function deleteCart()
    {
    	Cart::destroy();	
    }

    public function getCheckout()
    {
    	$this->data['title'] = "check out";
    	$this->data['cart'] = Cart::content();
    	$this->data['total'] = Cart::total();
    	return view('client.pages.checkout', $this->data);
    }

    public function postCheckout(Request $request)
    {
    	$id = $request->id;
    	$cartInfo = Cart::content();
    	$customer = Customer::find($id);
    	$this->validate($request, 
    		[
    			'name' => 'required',
    			'email' => 'required|email|unique:customers,email,'.$customer->id,
    			'address' => 'required',
    			'phone_number' => 'required|digits_between:10,12',
    		], 
    		[
    			'name.required' => 'Vui lòng nhập tên',
    			'email.required' => 'Vui lòng nhập email',
    			'email.email' => 'Địa chỉ email bạn vừa nhập không đúng',
    			'email.unique' => 'Email bạn vừa nhập đã tồn tại',
    			'phone_number.required' => 'Vui lòng nhập số điện thoại',
    			'phone_number.digits_between' => 'Số điện thoại bạn vừa nhập không đúng',
    			'address.required' => 'Vui lòng nhập địa chỉ',
    		]);
    	try {
    		$customer->name = $request->name;
	    	$customer->email = $request->email;
	    	$customer->address = $request->address;
	    	$customer->phone_number = $request->phone_number;
	    	$customer->save();

	    	$bill = new Bill;
	    	$bill->id_customer = $customer->id;
	    	$bill->date_order = date('Y-m-d');
	    	$bill->total = Cart::total();
	    	$bill->id_payment = 1;
	    	$bill->note = $request->note ? $request->note : '';
	    	$bill->save();

	    	if (count($cartInfo) > 0) {
	    		foreach ($cartInfo as $key => $item) {
	    			$billDetail = new BillDetail;
	    			$billDetail->id_bill = $bill->id;
	    			$billDetail->id_product = $item->id;
	    			$billDetail->quantity = $item->qty;
	    			$billDetail->current_unit_price = $item->price;
	    			$billDetail->save();

	    			$product = Product::find($item->id);
	    			$product->sell_quantity = $product->sell_quantity + $item->qty;
	    			$product->save();
	    		}
	    	}

	    	Cart::destroy();
    	} catch (Exception $e) {
    		echo $e->getMessage();
    	}
    	
    	return redirect('pages/home');
    }
}
