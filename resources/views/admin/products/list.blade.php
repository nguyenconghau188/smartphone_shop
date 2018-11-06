@extends('admin.layout.index')

@section('content')
            <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Phân khúc điện thoại
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{session('notification')}}
                            </div>
                        @endif
                        <thead>
                            <tr align="center">
                               <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Phân khúc</th>
                                <th>Nhà sản xuất</th>
                                <th>Giá</th>
                                <th>Giá khuyến mãi</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng bán</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr class="odd gradeX" align="center" onclick="openDetail({{$product->id}})">
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->typeProduct->name}}</td>
                                    <td>{{$product->manufactory->name}}</td>
                                    <td>{{$product->unit_price}}</td>
                                    <td>{{$product->promotion_price}}</td>
                                    <td><img src="upload/image/{{$product->image}}" alt="{{$product->name}}" style="width: 60px;"></td>
                                    <td>{{$product->sell_quantity}}</td>
                                    <td class="center"><a href="admin/types_product/delete/{{$product->id}}"> Xóa</a> | <a href="admin/types_product/edit/{{$product->id}}">Sửa</a></td>
                                </tr>
                                <div class="modal fade" id="myModal{{$product->id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" align="center">
                                                <h3>Chi tiết sản phẩm</h3>
                                            </div>
                                            <div class="modal-body" id="bodyModal">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                    <img src="upload/image/{{$product->image}}" alt="" style="width: 100%">
                                                </div>
                                                <div class="col-md-7">
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
                                                    <div class="form-group">
                                                        <label>Giá: &ensp;</label>{{ number_format($product->unit_price)}} VND
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                            </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
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

@section('script')
    <script>
        // $(document).ready(function(){
        //     $('#dataTables').on('click', 'td', function(){
        //         alert("hihi");
        //     });
        // });
        function openDetail(id)
        {
            $('#myModal'+id).modal();
        }
    </script>
@endsection