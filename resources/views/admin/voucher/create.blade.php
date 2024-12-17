@extends('layout.admin')
@section('content')
    <title>Thêm mới bài viết</title>
    <div class="content-wrapper">

        <section class="content-header">
            <!-- Content Header (Page header) -->
            <h1> Thêm mới voucher</h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.voucher.form')
        </section>
        <!-- /.content -->
        </section>
        <!-- /.content-wrapper -->
    </div>
@stop
