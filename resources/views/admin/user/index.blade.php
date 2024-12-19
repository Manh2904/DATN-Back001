@extends('layout.admin')
@section('content')
    <title>Thông tin sản phẩm</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Người dùng
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <table class="table text-center">
                <thead>
                <td>#</td>
                <td>Tên người dùng</td>
                <td>Điện thoại</td>
                <td>Đăng nhập bằng</td>
                <td>Tạo ngày</td>
                </thead>
                @foreach($user as $list )
                    <tbody>
                    <td>{{ $list->id}}</td>
                    <td>{{ $list->name}}</td>
                    <td>{{ $list->phone}}</td>
                    <td>{{ $list->provider ?? "Trực tiếp"}}</td>
                    <td>{{ $list->created_at}}</td>
                    <td>
                        <a href="{{  route('admin.user.delete', $list->id) }}" class="btn btn-xs btn-danger js-query-confirm"><i class="fa fa-trash"></i> Xóa</a>
                    </td>
                    </tbody>
                @endforeach
            </table>
        </section>
        <div class="box-footer">
            {!! $user->links() !!}
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
