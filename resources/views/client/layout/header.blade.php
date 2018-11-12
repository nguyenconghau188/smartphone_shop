    <div class="header-area">
        <div class="container">
            <div class="row">
                    <div class="user-menu" style="float: right;">
                        <ul>
                            @if(isset($customer_is_login))
                                <li><a href="pages/customer_profile/{{$customer_is_login->id}}"><i class="fa fa-user"></i>{{$customer_is_login->name}}</a></li>
                                <li><a href="pages/wishlist"><i class="fa fa-heart"></i> Yêu thích</a></li>
                                <li><a href="pages/cart_detail"><i class="fa fa-user"></i> Giỏ hàng</a></li>
                                <li><a href="logout"><i class="fa fa-user"></i> Đăng xuất</a></li>
                            @else
                                <li><a href="pages/wishlist"><i class="fa fa-heart"></i> Yêu thích</a></li>
                                <li><a href="pages/cart_detail"><i class="fa fa-user"></i> Giỏ hàng</a></li>
                                <li><a href="login"><i class="fa fa-user"></i> Đăng nhập</a></li>
                            @endif
                        </ul>
                    </div>
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="pages/home"><img src="client_asset/img/logo.png"></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="pages/cart_detail">Giỏ hàng - <span class="cart-amunt">$100</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">5</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->