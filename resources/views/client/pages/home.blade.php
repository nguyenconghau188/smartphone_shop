@extends('client.layout.index')

@section('content')
	@include('client.layout.slide')

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title" style="font-family: 'Roboto', sans-serif">SẢN PHẨM MỚI</h2>
                        <div class="product-carousel">
                        	@foreach($products as $product)
	                        	<div class="single-product">
	                                <div class="product-f-image">
	                                    <img src="upload/image/{{$product->image}}" alt="{{$product->name_title}}">
	                                    <div class="product-hover">
	                                    	<form action="pages/cart" method="POST" accept-charset="utf-8" id="formCart{{$product->id}}">
	                                    		<input type="hidden" name="product_id" value="{{$product->id}}">
	                                    		<input type="hidden" name="_token" value="{{csrf_token()}}">
	                                    		<a href="javascript: submitform()" class="add-to-cart-link" style="font-size: 12px;"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</a>
	                                    	</form>
	                                    	<a href="javascript: submitform({{$product->id}})" class="add-to-cart-link" style="font-size: 12px;"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</a>
	                                        <a href="pages/product/{{$product->id}}" class="view-details-link" style="font-size: 12px;"><i class="fa fa-link"></i> Xem chi tiết</a>
	                                    </div>
	                                </div>
	                                
	                                <h2><a href="pages/product/{{$product->id}}">{{$product->name}}</a></h2>
	                                
	                                <div class="product-carousel-price">
	                                	@if($product->promotion_price > 0)
	                                		<ins>{{number_format($product->promotion_price)}} VND</ins> <br>
	                                		<del>{{number_format($product->unit_price).' VND'}}</del>
	                                	@else
	                                		<ins>{{number_format($product->unit_price)}} VND</ins>
	                                	@endif
	                                    
	                                </div> 
	                            </div>
                        	@endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    @include('client.layout.brand')
    @include('client.layout.product_widget')
@endsection

@section('script')
	<script>
		function submitform(id)
		{
			document.getElementById('formCart'+id).submit();
		}
	</script>
@endsection