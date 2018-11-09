@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản trị viên
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div id="thongbao">
                            
                        </div>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {{$error}}
                                @endforeach
                            </div>
                        @endif
                        
                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{session('notification')}}
                            </div>
                        @endif

                        <form action="admin/users/edit/{{$user->id}}" method="POST">
                        	<input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <input class="form-control" name="username" placeholder="Nhập tên đăng nhập" value="{{$user->username}}" />
                            </div>
                            <div>
                                <label>Đổi mật khẩu</label> 
                                <input type="checkbox" name="changePassword" id="changePassword" value="1"/>                        
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input class="form-control" type="password" name="password" id="password" value="{{$user->password}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" value="{{$user->password}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label>Phân quyền</label>
                                <select class="form-control" name="permission" id="permission">
                                    <option
                                        @if($user->permission == "admin")
                                            {{"selected"}}
                                        @endif
                                        value="admin">Admin</option>
                                    <option
                                        @if($user->permission == "systemAdmin")
                                            {{"selected"}}
                                        @endif
                                        value="systemAdmin">System Admin</option>
                                </select>
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
                        <p>Giá trị của tầm giá phải là số!</p>
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
            $('#changePassword').change(function(){
                if ($(this).is(':checked')) {
                    $('#password').removeAttr("disabled");
                    $('#password').focus();
                    $('#confirmPassword').removeAttr("disabled");
                    $('#confirmPassword').focusout(function(){
                        if (document.getElementById('hienthongbao') != null) {
                            document.getElementById('hienthongbao').remove();
                        }
                        var confirmPassword = $('#confirmPassword').val();
                        var password = $('#password').val();
                        console.log('password ' + password);
                        console.log('confirmPassword ' + confirmPassword);
                        if (password !== confirmPassword) {
                            $('#password').val("");
                            $('#password').focus();
                            $('#confirmPassword').val("");
                            $('#thongbao').append("<div id='hienthongbao' class='alert alert-danger'>Mật khẩu và xác nhận mật khẩu không giống nhau </div>");
                    }
                    });

                }
                else
                {
                    $('#password').attr("disabled", "");
                    $('#confirmPassword').attr("disabled", "");
                }
            });
        });
    </script>
@endsection