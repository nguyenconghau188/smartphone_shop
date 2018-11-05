@extends('admin.layout.index')

@section('content')
	        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Product
                            <small>List</small>
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
                                <th>Hãng sản xuất</th>
                                <th>Quốc gia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($manufactories as $mn)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$mn->id}}</td>
                                    <td>{{$mn->name}}</td>
                                    <td>{{$mn->national}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/manufactories/delete/{{$mn->id}}"> Xóa</a> | <i class="fa fa-pencil fa-fw"></i> <a href="admin/manufactories/edit/{{$mn->id}}">Sửa</a></td>
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