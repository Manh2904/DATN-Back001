@extends('layout.admin')
@section('content')
    <title>Thông tin quản trị viên</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Quản trị viên
                <small><a href="{{ route('admin.qtv.create') }}" class="btn btn-success">Thêm mới</a></small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <table class="table text-center">
                <thead>
                <td>#</td>
                <td>Tên quản trị viên</td>
                <td>Email</td>
                </thead>
                @foreach($qtv as $list )
                    <tbody>
                    <td>{{ $list->id}}</td>
                    <td>{{ $list->name}}</td>
                    <td>{{ $list->email}}</td>
                    <td>
                        <a href="{{route('admin.qtv.update',$list->id) }}" class="btn btn-primary"><i
                                    class="fa fa-edit"></i> Sửa</a>
                        <a href="{{route('admin.qtv.delete',$list->id) }}"
                           class="btn btn-danger js-query-confirm"><i class="fa fa-times"></i> Xóa</a>
                    </td>
                    </tbody>
                @endforeach
            </table>
        </section>
        <div class="box-footer">
            {!! $qtv->links() !!}
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
