@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small>Thêm</small>
                        </h1>
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

                        <form action="admin/customers/add" method="POST">
                        	<input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <input class="form-control" name="username" placeholder="Nhập tên đăng nhập" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Nhập mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <input class="form-control" name="confirmPassword" type="password" id="confirmPassword" placeholder="Nhập lại mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" type="text" name="name" placeholder="Nhập họ tên">
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select name="gender" class="form-control">
                                    <option disabled selected value>--- Vui lòng chọn giới tính ---</option>
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="date" name="birthday" value="" placeholder="Nhập ngày sinh" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhập địa chỉ email" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" value="" placeholder="Nhập địa chỉ" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone_number" id="phone_number" placeholder="Nhập số điện thoại" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Phân quyền</label>
                                <select name="permission" class="form-control">
                                    <option disabled selected value>--- Vui lòng phân quyền người dùng ---</option>
                                    <option value="systemAdmin">Admin hệ thống</option>
                                    <option value="admin">Admin</option>
                                    <option value="customer">Khách hàng</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="active" class="form-control">
                                    <option disabled selected value>--- Chọn trạng thái người dùng ---</option>
                                    <option value="0">Chưa kích hoạt</option>
                                    <option value="1">Kích hoạt</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea name="note" class="form-control" placeholder="Nhập ghi chú"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
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

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#confirmPassword').focusout(function(){
                var password = $('#password').val();
                var confirmPassword = $('#confirmPassword').val();
                if (password !== confirmPassword) {
                    $('#password').val("");
                    $('#password').focus();
                    $('#confirmPassword').val("");
                    //$('#myModal').modal();
                    $('#thongbao').append("<div class='alert alert-danger'>Mật khẩu và xác nhận mật khẩu không giống nhau </div>");
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