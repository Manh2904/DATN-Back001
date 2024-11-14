@extends('layout.admin')
@section('content')
    <title>Thông tin menu</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Menu
                <small><a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Thêm mới</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.menu.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Danh mục</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <table class="table text-center">
                    <thead>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Avatar</th>
                    <th>Status</th>
                    <th>Hot</th>
                    <th>Thời gian tạo</th>
                    <th>Thời gian sửa</th>
                    <th>Action</th>
                    </thead>
                    @if(isset($menu))
                        @foreach($menu as $list)
                            <tbody>

                            <td>{{$list->id}}</td>
                            <td>{{$list->mn_name}}</td>
                            <td>
                                <img src="{{ pare_url_file($list->mn_avatar ?? '') ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTzMcYWJkLEXnPD7zTbRwdnNRjjNPJDdP4ePQ&usqp=CAU' }}"
                                     onerror="this.onerror=null;this.src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTzMcYWJkLEXnPD7zTbRwdnNRjjNPJDdP4ePQ&usqp=CAU';"
                                     class="img-thumbnail" style="width: 100px;height: 100px;"></td>
                            <td>
                                @if($list->mn_status ==1 )
                                    <a href="{{ route('admin.menu.active',$list->id) }}"
                                       class="btn btn-primary">Show</a>
                                @else
                                    <a href="{{ route('admin.menu.active',$list->id) }}"
                                       class="btn btn-default">Hide</a>
                                @endif
                            </td>
                            <td>
                                @if($list->mn_hot ==1 )
                                    <a href="{{ route('admin.menu.hot',$list->id) }}" class="btn btn-primary">Hot</a>
                                @else
                                    <a href="{{ route('admin.menu.hot',$list->id) }}" class="btn btn-default">None</a>
                                @endif
                            </td>
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