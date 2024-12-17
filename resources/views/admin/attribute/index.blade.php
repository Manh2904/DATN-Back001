@extends('layout.admin')
@section('content')
    <title>Quản lý biến thể</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Biến thể
                <small><a href="{{ route('admin.attribute.create') }}" class="btn btn-success">Thêm mới</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Biến thể</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <table class="table text-center">
                <thead>
                <td>#</td>
                <td>Biến thể</td>
                <td>Danh mục</td>
                <td>Thời gian tạo</td>
                <td>Thời gian cập nhật</td>
                <td>Hành động</td>
                </thead>
                @if (isset($attributes))
                    @foreach($attributes as $list)
                        <tbody>
                        <td>{{ $list->id}}</td>
                        <td>{{ $list->name}}</td>
                        <td>{{ $list->menus->name ?? "[N\A]" }}</td>
                        <td>{{ $list->created_at}}</td>
                        <td>{{ $list->updated_at}}</td>

                        <td>
                            <a href="{{route('admin.attribute.update',$list->id) }}" class="btn btn-primary"><i
                                        class="fa fa-edit"></i> Sửa</a>
                            <a href="{{route('admin.attribute.delete',$list->id) }}"
                               class="btn btn-danger js-query-confirm"><i class="fa fa-times"></i> Xóa</a>
                        </td>
                        </tbody>
                    @endforeach
                @endif
            </table>
        </section>
        <div class="box-footer">
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
