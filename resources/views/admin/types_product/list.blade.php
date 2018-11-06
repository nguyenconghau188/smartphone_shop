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
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{session('notification')}}
                            </div>
                        @endif
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Phân khúc</th>
                                <th>Tầm giá</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($types as $type)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$type->id}}</td>
                                    <td>{{$type->name}}</td>
                                    <td>{{$type->price_range}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/types_product/delete/{{$type->id}}"> Xóa</a> | <i class="fa fa-pencil fa-fw"></i> <a href="admin/types_product/edit/{{$type->id}}">Sửa</a></td>
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