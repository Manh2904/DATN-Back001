@extends('layout.admin')
@section('content')
    <title>Sửa menu</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa danh mục biến thể
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index') }}"> Trang chủ</a></li>
                <li><a href="{{ route('admin.menu.index') }}">Danh mục biến thể</li>
                >
                <li><a href="#">Sửa</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="" method="POST" role="form" class="col-md-8">
                @csrf
                <div class="form-group {{ $errors->first('name') ? ' has-error':'' }}">
                    <label for="exampleInputEmail1">Danh mục</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                           value="{{ $menu->name }}">
                    @if ($errors->first('name'))
                        <p class="text-danger">{{$errors->first('name') }}  </p>
                    @endif
                </div>

                <a href="{{route('admin.menu.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Quay lại</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
