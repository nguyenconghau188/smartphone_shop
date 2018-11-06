@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Phân khúc điện thoại
                            <small>Sửa</small>
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

                        <form action="admin/types_product/edit/{{$type->id}}" method="POST">
                        	<input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên phân khúc</label>
                                <input class="form-control" name="name" placeholder="Nhập tên phân khúc" value="{{$type->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Tầm giá</label>
                                <input class="form-control" name="price_range" id="price" placeholder="Nhập giá trị cao nhất của tầm giá" value="{{$type->price_range}}"/>
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
            $('#price').focusout(function(){
                var price = $('#price').val();
                if (isNaN(price)) {
                    $('#price').val("");
                    $('#myModal').modal();
                }
            });
        });
    </script>
@endsection