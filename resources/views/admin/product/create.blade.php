@extends('layout.admin')
@section('content')
    <title>Thêm sản phẩm</title>
    <div class="content-wrapper">

        <section class="content-header">
            <!-- Content Header (Page header) -->
            <h1> Thêm sản phẩm</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index') }}"> Trang chủ</a></li>
                <li><a href="{{ route('admin.product.index') }}">Sản phẩm</li>
                >
                <li><a href="#" class="active">Thêm mới</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.product.form')

        </section>
        <!-- /.content -->
        </section>
        <!-- /.content-wrapper -->
    </div>

@stop