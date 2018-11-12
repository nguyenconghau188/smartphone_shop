@extends('client.layout.index')

@section('content')

	<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2  style="font-family: 'Roboto', sans-serif">Đặt hàng</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->
	<div class="container">
		<div class="row">
                    <!-- /.col-lg-12 -->
                <div class="col-md-12">
                	<div class="col-md-6" style="padding:3em">
                    	<h2 class="page-header">Thông tin khách hàng đặt mua
                        </h2>
                        <div id="thongbao">
                            
                        </div>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {{$error}} <br>
                                @endforeach
                            </div>
                        @endif
                        
                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{session('notification')}}
                            </div>
                        @endif

                        <form action="pages/checkout" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" value="{{$customer_is_login->id}}">
                            <div class="form-group">
                                <label>Tên khách hàng</label>
                                <input class="form-control" name="name" placeholder="Vui lòng nhập tên" value="{{$customer_is_login->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhập địa chỉ email" value="{{$customer_is_login->email}}" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" placeholder="Nhập địa chỉ" class="form-control" value="{{$customer_is_login->address}}">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone_number" id="phone_number" placeholder="Nhập số điện thoại" class="form-control" value="{{$customer_is_login->phone_number}}">
                            </div>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea name="note" class="form-control" placeholder="Nhập ghi chú"></textarea>
                            </div>
                        <form>
                    </div>
                    <div class="col-md-6" style="padding: 3em">
                    	<h2 class="page-header">Hóa đơn
                        </h2>
                        <div id="thongbao">
                            
                        </div>
                                    <table class="shop_table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Sản phẩm</th>
                                                <th class="product-total">Tổng cộng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@if(count($cart))
                                        		@foreach($cart as $item)
												<tr class="cart_item">
	                                                <td class="product-name">
	                                                    {{$item->name}} <strong class="product-quantity">× {{$item->qty}}</strong> </td>
	                                                <td class="product-total">
	                                                    <span class="amount">
	                                                    	<?php
	                                                    		$cost = $item->price * $item->qty;
	                                                    		echo number_format($cost).' VND';
	                                                    	?>
	                                                    </span> </td>
	                                            </tr>
                                        		@endforeach
                                        	@endif  
                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <th>Thành tiền</th>
                                                <td><strong><span class="amount">{{$total}} VND</span></strong> </td>
                                            </tr>
                                        	<tr>
                                        		<th>Tiến hành đặt hàng</th>
                                        		<td><input type="submit" value="Đặt hàng" name="proceed" class="checkout-button button alt wc-forward"></td>
                                        	</tr> 	
                                        </tfoot>
                                    </table>
                             
                    </div>
                </div>
            <h3>Chi tiết đặt mua</h3>   
			<table class="shop_table cart">
                                    <thead>
                                        <tr>       
                                            <th class="product-thumbnail">Hình ảnh</th>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Thành tiền</th>
                                            <th class="product-remove">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@if(count($cart))
	                                    	@foreach($cart as $item)
		                                    	<tr class="cart_item">
		                                            <td class="product-thumbnail">
		                                                <a href="pages/product/{{$item->id}}"><img style="width: 10em;" height="145" alt="poster_1_up" class="shop_thumbnail" src="upload/image/{{$item->options->image}}"></a>
		                                            </td>

		                                            <td class="product-name">
		                                                <a href="pages/product/{{$item->id}}">{{$item->name}}</a> 
		                                            </td>

		                                            <td class="product-price">
		                                                <span class="amount">{{number_format($item->price)}} VND</span> 
		                                            </td>

		                                            <td class="product-quantity">
		                                                <span class="amount">{{$item->qty}}</span>
		                                            </td>

		                                            <td class="product-subtotal">
		                                                <span class="amount">
		                                                	<?php
		                                                		$cost = $item->price * $item->qty;
		                                                		echo number_format($cost).' VND';
		                                                	?>
		                                                </span> 
		                                            </td>
		                                            <td class="product-remove">
		                                                <a title="Remove this item" class="remove" href="pages/removeItem/{{$item->id}}">X</a> 
		                                            </td>
		                                        </tr>
	                                    	@endforeach
                                    	@endif
                                    	
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <a class="add_to_cart_button" href="pages/deleteCart">Tiếp tục mua hàng</a>
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

		</div>
		
	</div>
@endsection