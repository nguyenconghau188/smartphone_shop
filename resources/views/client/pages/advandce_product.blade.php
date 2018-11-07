@extends('client.layout.index')

@section('content')
	<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2 style="font-family: 'Roboto', sans-serif">Sản phẩm cao cấp</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
            	@foreach($products as $product)
	                <div class="col-md-3 col-sm-6">
	                    <div class="single-shop-product">
	                        <div class="product-upper">
	                        	<a href="pages/product/{{$product->id}}">
	                        		<img src="upload/image/{{$product->image}}" alt="{{$product->name_title}} href="#">
	                        	</a>                          
	                        </div>
	                        <h2><a href="">{{$product->name}}</a></h2>
	                        <div class="product-carousel-price">
	                        	@if($product->promotion_price > 0)
	                        		<ins>{{number_format($product->promotion_price)}} VND</ins> <del>{{number_format($product->unit_price)}} VND</del>
	                        	@else
	                        		<ins>{{number_format($product->unit_price)}} VND</ins>
	                        	@endif
	                        </div>  
	                        
	                        <div class="product-option-shop">
	                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Thêm vào giỏ</a>
	                        </div>                       
	                    </div>
	                </div>
            	@endforeach

            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">        
	                    <!-- Pagination -->
	                    {{$products->links()}}
	                    <!-- /.row -->        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection