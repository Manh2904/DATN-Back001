@extends('layout.admin')
@section('content')
    <title>Thông tin menu</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Danh mục biến thể
                <small><a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Thêm mới</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.menu.index') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Danh mục biến thể</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <table class="table text-center">
                    <thead>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Thời gian tạo</th>
                    <th>Thời gian sửa</th>
                    <th>Hành động</th>
                    </thead>
                    @if(isset($menu))
                        @foreach($menu as $list)
                            <tbody>

                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->created_at}}</td>
                            <td>{{$list->updated_at}}</td>
                            <td><a href="{{route('admin.menu.update',$list->id) }}" class="btn btn-primary"><i
                                            class="fa fa-edit"></i> Sửa</a>
                                <a href="{{route('admin.menu.delete',$list->id) }}"
                                   class="btn btn-danger js-query-confirm"><i class="fa fa-times"></i> Xóa</a></td>


                            </tbody>
                        @endforeach
                    @endif
                </table>
                <div class="box-footer">
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
