@extends('layout.admin')
@section('content')
    <title>Thêm mới quản trị viên</title>
    <div class="content-wrapper">

        <section class="content-header">
            <!-- Content Header (Page header) -->
            <h1> Thêm mới quản trị viên</h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.qtv.form')
        </section>
        <!-- /.content -->
        </section>
        <!-- /.content-wrapper -->
    </div>
@stop
