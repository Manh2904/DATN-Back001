@extends('layout.admin')
@section('content')
    <title>Thông tin sản phẩm</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sản phẩm
                <small><a href="{{ route('admin.product.create') }}" class="btn btn-success">Thêm mới</a></small>
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
                <td>Tên sản phẩm</td>
                <td>Giá</td>
                <td>Số lượng</td>
                <td>Thể loại</td>
                <td>Người đăng</td>
                <td>Avatar</td>
                <td>Sản phẩm nổi bật</td>
                <td>Active</td>
                <td>Pay</td>
                <td>View</td>
                <td>Action</td>
                </thead>
                @foreach($product as $key => $list )
                    <tbody>
                    <td>{{ ((Request::get('page') ?? 1) - 1) * 10 + $key + 1 }}</td>
                    <td>{{ $list->pro_name}}</td>
                    <td>{{ number_format( $list->pro_price) }}</td>
                    <td>{{ $list->pro_amount}}</td>
                    <td><span class="label label-info">{{ $list->category->c_name ??"[N\A]" }}</span></td>
                    <td>{{ $list->pro_admin_id}}</td>
                    <td><img src="{{ $list->pro_avatar }}" style="width:80px;height:100px"></td>
                    <td>
                        @if($list->pro_hot == 1)
                            <a href="{{route('admin.product.hot',$list->id) }}" class="btn btn-primary">Bật</a>
                        @else
                            <a href="{{route('admin.product.hot',$list->id) }}" class="btn btn-success">Tắt</a>
                        @endif
                    </td>
                    <td>
                        @if($list->pro_active == 0)
                            <a href="{{route('admin.product.active',$list->id) }}" class="btn btn-success">Hide</a>
                        @else
                            <a href="{{route('admin.product.active',$list->id) }}" class="btn btn-primary">Show</a>
                        @endif
                    </td>
                    <td>{{$list->pro_pay }}</td>
                    <td>{{$list->pro_view }}</td>
                    <td>
                        <a href="{{route('admin.product.update',$list->id) }}" class="btn btn-primary"><i
                                    class="fa fa-edit"></i> Sửa</a>
                        <a href="{{route('admin.product.delete',$list->id) }}"
                           class="btn btn-danger js-query-confirm"><i class="fa fa-times"></i> Xóa</a>
                    </td>
                    </tbody>
                @endforeach
            </table>
        </section>
        <div class="box-footer">
            {!! $product->links() !!}
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
