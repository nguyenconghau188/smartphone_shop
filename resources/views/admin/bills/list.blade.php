@extends('admin.layout.index')

@section('content')
            <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn hàng
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
                                <th>Tên khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày đặt hàng</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bills as $bill)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$bill->id}}</td>
                                    <td>{{$bill->customer->name}}</td>
                                    <td>{{$bill->customer->address}}</td>
                                    <td>{{$bill->customer->phone_number}}</td>
                                    <td>{{$bill->customer->email}}</td>
                                    <td>{{$bill->date_order}}</td>
                                    <td>{{$bill->payment->name}}</td>
                                    <td>{{$bill->total}} VND</td>
                                    <td>{{$bill->note}}</td>
                                    <td>
                                        <?php
                                        if($bill->status == 0)
                                            echo "Chưa xử lý";
                                        else if ($bill->status == 1)
                                            echo "Xong";
                                        ?>
                                    </td>
                                    <td class="center"></i><a href="admin/bills/bill_detail/{{$bill->id}}"> Chi tiết</a> |  <a href="admin/bills/delete/{{$bill->id}}">Xóa</a></td>
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