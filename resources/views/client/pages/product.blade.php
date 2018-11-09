@extends('client.layout.index')

@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
					<div role="tabpanel">
                        <ul class="product-tab" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Chi tiết</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Nhận xét</a></li>
                        </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                        <div class="form-group">
                                            <label>Tên sản phẩm: &ensp;</label>{{$product->name}}
                                        </div>
                                        <div class="form-group">
                                            <label>Phân khúc: &ensp;</label>{{$product->typeProduct->name}}
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả: &ensp;</label>
                                            	<?php echo($product->description);?>
                                            </div>
                                        <div class="form-group">
                                            <label>Hãng sản xuất: &ensp;</label>{{$product->manufactory->name}}
                                        </div>
                                        <div class="form-group">
                                            <label>Xuất xứ: &ensp;</label> {{$product->manufactory->national}}
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="profile">
                                        <h2>Reviews</h2>
                                        <div class="submit-review">
                                            <p><label for="name">Name</label> <input name="name" type="text"></p>
                                            <p><label for="email">Email</label> <input name="email" type="email"></p>
                                            <div class="rating-chooser">
                                                <p>Your rating</p>

                                            	<div class="rating-wrap-post">
                                                	<i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                        	<p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                            <p><input type="submit" value="Submit"></p>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="pages/home">Trang chủ</a>
                            <a href="pages/<?php 
                            			if($product->id_type == 1)
                            				echo "basic_product";
                            			else if($product->id_type == 2)
                            				echo "normal_product";
                            			else if($product->id_type == 3)
                            				echo "nearadv_product";
                            			else if($product->id_type == 5)
                            				echo "advandce_product";
                            			?>">{{$product->typeProduct->name}}</a>
                            <a href="pages/product/{{$product->id}}">{{$product->name}}</a>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                	<h2 class="product-name">{{$product->name}}</h2> <br>
                                    <div class="product-main-img">
                                        <img src="upload/image/{{$product->image}}" alt="{{$product->name_title}}">
                                    </div>
                                    
                                    <div class="product-gallery">
                                        <img src="" alt="">
                                        <img src="" alt="">
                                        <img src="" alt="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">{{$product->name}}</h2>
                                    <div class="product-inner-price">
                                        @if($product->promotion_price > 0)
			                        		<ins>{{number_format($product->promotion_price)}} VND</ins> <del>{{number_format($product->unit_price)}} VND</del>
			                        	@else
			                        		<ins>{{number_format($product->unit_price)}} VND</ins>
			                        	@endif
                                    </div>    
                                    
                                    <form action="" class="cart">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                        </div>
                                        <button class="add_to_cart_button" type="submit">Thêm vào giỏ</button>
                                    </form>                              
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Sản phẩm liên quan</h2>
                            <div class="related-products-carousel">
                                
                           		@foreach($relateProducts as $relate)                                    
                           			<div class="single-product">
	                                    <div class="product-f-image">
	                                        <img src="upload/image/{{$relate->image}}" alt="{{$relate->name_title}}">
	                                        <div class="product-hover">
	                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</a>
	                                            <a href="pages/product/{{$relate->id}}" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
	                                        </div>
	                                    </div>

	                                    <h2><a href="pages/product/{{$relate->id}}">{{$relate->name}}</a></h2>

	                                    <div class="product-carousel-price">
	                                        @if($relate->promotion_price > 0)
				                        		<ins>{{number_format($relate->promotion_price)}} VND</ins> <del>{{number_format($relate->unit_price)}} VND</del>
				                        	@else
				                        		<ins>{{number_format($relate->unit_price)}} VND</ins>
				                        	@endif
	                                    </div> 
	                                </div>
                           		@endforeach
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection