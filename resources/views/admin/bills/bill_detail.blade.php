@extends('admin.layout.index')

@section('content')
            <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn hàng
                            <small>Chi tiết</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    	@if(session('notification'))
                            <div class="alert alert-success">
                                {{session('notification')}}
                            </div>
                        @endif
                    <div class="col-md-8">
                    	<table class="table table-bordered table-hover">
	                        <thead>
	                            <tr align="center">
	                                <th>Thông tin khách hàng</th>
	                                <th></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr>
	                            	<th>Tên khách hàng</th>
	                            	<td>{{$bill->customer->name}}</td>
	                            </tr>
	                            <tr>
	                            	<th>Ngày đặt hàng</th>
	                            	<td>{{$bill->date_order}}</td>
	                            </tr>
	                            <tr>
	                            	<th>Số điện thoại</th>
	                            	<td>{{$bill->customer->phone_number}}</td>
	                            </tr>
	                            <tr>
	                            	<th>Địa chỉ</th>
	                            	<td>{{$bill->customer->address}}</td>
	                            </tr>
	                            <tr>
	                            	<th>Email</th>
	                            	<td>{{$bill->customer->email}}</td>
	                            </tr>
	                            <tr>
	                            	<th>Ghi chú</th>
	                            	<td>{{$bill->note}}</td>
	                            </tr>
	                        </tbody>
                    	</table>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill->billDetails as $key => $item)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{number_format($item->current_unit_price)}} VND</td>
                                    <td>{{number_format($item->quantity * $item->current_unit_price)}} VND</td>
                                </tr>
                            @endforeach
                            <tr>
                            	<td colspan="4"><b>Tổng tiền</b></td>
                            	<td><b class="text-red">{{$bill->total}} VND</b></td>
                            </tr>
                        </tbody>
                    </table>
					<form action="admin/bills/billStatus" method="post" accept-charset="utf-8">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="form-inline" style="margin: 2em;">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="id" value="{{$bill->id}}" placeholder="">
								<label>Trạng thái giao hàng: </label>
								<select name="status" class="form-control input-inline" style="width: 10em">
	                                <option 
									<?php
										if($bill->status == 0)
											echo "selected";
									?>
	                                value="0">Chưa xử lý</option>
	                                <option
	                                <?php
										if($bill->status == 1)
											echo "selected";
									?> 
	                                value="1">Đã xử lý</option>
	                            </select>

	                            <input type="submit" value="Xử lý" class="btn btn-primary">
							</div>
						</div>
					</form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection