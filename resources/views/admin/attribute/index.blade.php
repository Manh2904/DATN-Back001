@extends('layout.admin')
@section('content')
    <title>Quản lý thuộc tính</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thuộc tính
                <small><a href="{{ route('admin.attribute.create') }}" class="btn btn-success">Thêm mới</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Attribute</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <table class="table text-center">
                <thead>
                <td>#</td>
                <td>Thuộc tính</td>
                <td>Type</td>
                <td>Category</td>
                <td>Time</td>
                <td>Update</td>
                <td>Action</td>
                </thead>
                @if (isset($attributes))
                    @foreach($attributes as $list)
                        <tbody>
                        <td>{{ $list->id}}</td>
                        <td>{{ $list->atb_name}}</td>
                        <td>
      <span class="{{ $list->getType($list->atb_type)['class'] }}">
      {{ $list->getType($list->atb_type)['name'] }}</span></td>
                        <td><span class="label label-info">{{ $list->category->c_cate ?? "[N\A]" }}</span></td>
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