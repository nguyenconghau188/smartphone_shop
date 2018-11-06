@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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

                        @if(session('fail'))
                            <div class="alert alert-danger">
                                {{session('fail')}}
                            </div>
                        @endif

                        <form action="admin/products/edit/{{$product->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{$product->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input class="form-control" name="product_code" placeholder="Nhập mã sản phẩm" value="{{$product->product_code}}" />
                            </div>
                            <div class="form-group">
                                <label>Phân khúc</label>
                                <select class="form-control" name="id_type" id="id_type">
                                    <option disabled selected value>--- Vui lòng chọn phân khúc ---</option>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}"
                                            @if($type->id == $product->id_type)
                                                {{"selected"}}
                                            @endif
                                            >{{$type->name}}</option>}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" name="description" placeholder="Nhập mô tả sản phẩm">{{$product->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Giá (VND)</label>
                                <input class="form-control" name="unit_price" id="unit_price" placeholder="Nhập giá sản phẩm"  value="{{$product->unit_price}}" />
                            </div>
                            <div class="form-group">
                                <label>Giá khuyến mãi (VND)</label>
                                <input class="form-control" name="promotion_price" id="promotion_price" placeholder="Nhập quốc giá khuyến mãi" value="{{$product->promotion_price}}" />
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input class="form-control" type="file" name="image" placeholder="Chọn hình ảnh sản phẩm"  value="{{$product->image}}" />
                            </div>
                            <div class="form-group">
                                <label>Hãng sản xuất</label>
                                <select class="form-control" name="id_manufactory">
                                    <option disable selected value>--- Vui lòng chọn nhà sản xuất ---</option>
                                    @foreach($manus as $manu)
                                    <option value="{{$manu->id}}"
                                        @if($manu->id == $product->id_manufactory)
                                            {{"selected"}}
                                        @endif
                                        >{{$manu->name}}</option>}
                                    @endforeach
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
                        <p>Giá trị nhập vào phải là số!</p>
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
            $('#unit_price').focusout(function(){
                var price = $('#unit_price').val();
                if (isNaN(price)) {
                    $('#unit_price').val("");
                    $('#myModal').modal();
                }
            });

            $('#promotion_price').focusout(function(){
                var price = $('#promotion_price').val();
                if (isNaN(price)) {
                    $('#promotion_price').val("");
                    $('#myModal').modal();
                }
            });
        });
    </script>
@endsection