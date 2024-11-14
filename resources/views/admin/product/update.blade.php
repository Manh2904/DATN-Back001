@extends('layout.admin')
@section('content')
    <title>Sửa thông tin sản phẩm</title>
    <div class="content-wrapper">

        <section class="content-header">
            <!-- Content Header (Page header) -->
            <h1> Sửa thông tin sản phẩm</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index') }}"> Home</a></li>
                <li><a href="{{ route('admin.product.index') }}">Product</li>
                >
                <li><a href="#" class="active">Update</a></li>
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