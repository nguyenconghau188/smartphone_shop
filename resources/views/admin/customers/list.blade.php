@extends('admin.layout.index')

@section('content')
            <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{session('notification')}}
                            </div>
                        @endif
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Tên đăng nhập</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Phân quyền</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>
                                        <?php
                                        if($customer->gender == "male")
                                            echo "Nam";
                                        else
                                            echo "Nữ";
                                        ?>
                                    </td>
                                    <td>{{$customer->username}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->phone_number}}</td>
                                    <td>
                                        <?php
                                        if($customer->permission == 1)
                                            echo "Admin hệ thống";
                                        else if ($customer->permission == 2)
                                            echo "Admin";
                                        else
                                            echo "Khách hàng";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($customer->gender == 1)
                                            echo "Kích hoạt";
                                        else
                                            echo "Chưa kích hoạt";
                                        ?>
                                    </td>
                                    <td class="center"></i><a href="admin/customers/delete/{{$customer->id}}"> Xóa</a> |  <a href="admin/customers/edit/{{$customer->id}}">Sửa</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection