@extends('layout.admin')
@section('content')
    <title>Thông tin từ khóa</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Từ khóa
                <small><a href="{{ route('admin.keyword.create') }}" class="btn btn-success">Thêm mới</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Keyword</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <table class="table text-center">
                <thead>
                <td>#</td>
                <td>Từ khóa</td>
                <td>Mô tả</td>
                <td>Hot</td>
                <td>Status</td>
                <td>Action</td>
                </thead>
                @foreach($keyword as $list)
                    <tbody>
                    <td>{{ $list->id}}</td>
                    <td>{{ $list->k_name}}</td>
                    <td>{{ $list->k_description}}</td>
                    <td>
                        @if($list->k_hot == 1)
                            <a href="{{route('admin.keyword.hot',$list->id) }}" class="btn btn-primary">Hot</a>
                        @else
                            <a href="{{route('admin.keyword.hot',$list->id) }}" class="btn btn-success">None</a>
                        @endif
                    </td>
                    <td>
                        @if($list->k_active == 1)
                            <a href="{{route('admin.keyword.active',$list->id) }}" class="btn btn-success">Hide</a>
                        @else
                            <a href="{{route('admin.keyword.active',$list->id) }}" class="btn btn-primary">Show</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin.keyword.update',$list->id) }}" class="btn btn-primary"><i
                                    class="fa fa-edit"></i> Sửa</a>
                        <a href="{{route('admin.keyword.delete',$list->id) }}"
                           class="js-query-confirm btn btn-danger"><i class="fa fa-times"></i> Xóa</a>
                    </td>
                    </tbody>
                @endforeach
            </table>
        </section>
        <div class="box-footer">
            {!! $keyword->links() !!}
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop