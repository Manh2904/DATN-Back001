@extends('layout.admin')
@section('content')
    <title>Thông tin voucher</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               voucher
                <small><a href="{{ route('admin.voucher.create') }}" class="btn btn-success">Thêm mới</a></small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <table class="table text-center">
                <thead>
                <td>#</td>
                <td>Tên voucher</td>
                <td>Trạng thái</td>
                <td>Giảm giá</td>
                <td>Giá trị tối thiểu</td>
                <td>Ngày hết hạn</td>
                <td>Tạo lúc</td>
                <td>Sửa lúc</td>
                <td>Hành động</td>
                </thead>
                @foreach($voucher as $list )
                    <tbody>
                    <td>{{ $list->id}}</td>
                    <td>{{ $list->name}}</td>
                    <td>
                        @if($list->active == 1)
                            <a href="{{route('admin.voucher.active',$list->id) }}" class="btn btn-success">Active</a>
                        @else
                            <a href="{{route('admin.voucher.active',$list->id) }}" class="btn btn-primary">Ẩn</a>
                        @endif
                    </td>
                    <td>{{ number_format($list->amount,0,',','.') }}</td>
                    <td>{{ number_format($list->minimum,0,',','.') }}</td>
                    <td><span class="label label-danger">{{ $list->expired_date }}</span></td>

                    <!-- <td>{{$list->a_content }}</td> -->
                    <td>{{$list->created_at}}</td>
                    <td>{{$list->updated_at }}</td>
                    <td>
                        <a href="{{route('admin.voucher.update',$list->id) }}" class="btn btn-primary"><i
                                    class="fa fa-edit"></i> Sửa</a>
                        <a href="{{route('admin.voucher.delete',$list->id) }}"
                           class="btn btn-danger js-query-confirm"><i class="fa fa-times"></i> Xóa</a>
                    </td>
                    </tbody>
                @endforeach
            </table>
        </section>
        <div class="box-footer">
            {!! $voucher->links() !!}
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
