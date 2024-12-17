@extends('layout.admin')
@section('content')
    <title>Phản hồi từ khách hàng</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Phản hồi từ khách hàng
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.rating') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Danh sách</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <table class="table text-center">
                    <thead>
                    <th>#</th>
                    <th>Người đăng</th>
                    <th>Sản phẩm</th>
                    <th style="float:left">Đánh giá</th>
                    <th>Nội dung</th>
                    <th>Phản hồi lúc</th>
                    </thead>
                    @if($rating)
                        @foreach($rating as $list)
                            <tbody>
                            <td>{{$list->id }}</td>
                            <td>{{ $list->user->name }}(#{{ $list->r_user_id}})</td>
                            <td>{{ $list->product->pro_name }}(#{{  $list->r_product_id}})</td>
                            <td style="float:left">@for($i=1 ;$i <=$list->r_number;$i++)
                                    <i class="fa fa-star"></i>
                                @endfor</td>
                            <td>{{$list->r_content}}</td>
                            <td>{{$list->created_at}}</td>


                            </tbody>
                        @endforeach
                    @endif
                </table>
                <div class="box-footer">
                    {!! $rating->links() !!}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop