@extends('client.layout.index')

@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2 style="font-family: 'Roboto', sans-serif">Sản phẩm cận cao cấp</h2>
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
                        <div class="single-product">
                            <div class="product-f-image">
                                        <img src="upload/image/{{$product->image}}" alt="{{$product->name_title}}">
                                        <div class="product-hover">
                                            <a href="#" class="add-to-cart-link" style="font-size: 12px;"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</a>
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