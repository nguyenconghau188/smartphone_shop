@extends('client.layout.index')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="single-sidebar" style="margin-left: 20%; margin-top: 10%;">
                    <h2 class="sidebar-title">Tùy chọn</h2>
                    <ul>
                        <li><a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                        <li><a href="" class="add-to-cart-link"><i class="fa fa-heart"></i> Yêu thích</a></li>
                        <li><a href="">Sony Smart TV - 2015</a></li>
                        <li><a href="">Sony Smart TV - 2015</a></li>
                        <li><a href="">Sony Smart TV - 2015</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Người dùng
                            <small>Thông tin</small>
                        </h2>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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

                        <form action="pages/customer_profile/{{$customer->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <input class="form-control" name="username" placeholder="Nhập tên đăng nhập" value="{{$customer->username}}" />
                            </div>
                            <div class="form-group">
                                <label>Đổi mật khẩu</label>
                                <input type="checkbox" name="changePassword" id="changePassword" value="1">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Nhập mật khẩu" value="{{$customer->password}}" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <input class="form-control" name="confirmPassword" type="password" id="confirmPassword" placeholder="Nhập lại mật khẩu" value="{{$customer->password}}" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" type="text" name="name" placeholder="Nhập họ tên" value="{{$customer->name}}">
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select name="gender" class="form-control">
                                    <option disabled selected value>--- Vui lòng chọn giới tính ---</option>
                                    <option 
                                    @if($customer->gender == 'male')
                                        {{'Selected'}}
                                    @endif
                                    value="male">Nam</option>
                                    <option 
                                    @if($customer->gender == 'female')
                                        {{'Selected'}}
                                    @endif
                                    value="female">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="date" name="birthday" placeholder="Nhập ngày sinh" class="form-control" value="<?php echo $customer->birthday;?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhập địa chỉ email" value="{{$customer->email}}" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" placeholder="Nhập địa chỉ" class="form-control" value="{{$customer->address}}">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone_number" id="phone_number" placeholder="Nhập số điện thoại" class="form-control" value="{{$customer->phone_number}}">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <input type="text" name="active" class="form-control" value="{{$customer->active ? 'Kích hoạt' : 'Chưa kích hoạt'}}" placeholder="" disabled>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>Mật khẩu và xác nhận mật khẩu không giống nhau</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#changePassword').change(function() {
                if ($(this).is(':checked')) {
                    $('#password').removeAttr('disabled');
                    $('#confirmPassword').removeAttr('disabled');
                    $('#password').select();
                    $('#confirmPassword').focusout(function(){
                        var password = $('#password').val();
                        var confirmPassword = $('#confirmPassword').val();
                        if (document.getElementById('ndthongbao')) {
                            $('#ndthongbao').remove();
                        }
                        if (password !== confirmPassword) {
                            $('#password').val("");
                            $('#password').focus();
                            $('#confirmPassword').val("");
                            //$('#myModal').modal();
                            $('#thongbao').append("<div id='ndthongbao' class='alert alert-danger'>Mật khẩu và xác nhận mật khẩu không giống nhau </div>");
                        }
                    });
                }
                else {
                    $('#password').attr('disabled', '');
                    $('#confirmPassword').attr('disabled', '')
                }
            });

            $('#phone_number').focusout(function(){
                var phone = $('#phone_number').val();
                if (isNaN(phone)) {
                    $('#phone_number').val("");
                    $('#phone_number').focus();
                    $('#thongbao').append("<div class='alert alert-danger'>Dữ liệu nhập vào không phải là số điện thoại</div>");
                }
            });
        });
    </script>
@endsection