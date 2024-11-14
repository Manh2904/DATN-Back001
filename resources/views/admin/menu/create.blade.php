@extends('layout.admin')
@section('content')
    <title>Thêm mới menu</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm mới menu
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index') }}"> Home</a></li>
                <li><a href="{{ route('admin.menu.index') }}">Menu</li>
                >
                <li><a href="#">Add</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="" method="POST" role="form" class="col-md-8">
                @csrf
                <div class="form-group {{ $errors->first('mn_name') ? ' has-error':'' }}">
                    <label for="exampleInputEmail1">Danh mục</label>
                    <input type="text" name="mn_name" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp">
                    @if ($errors->first('mn_name'))
                        <p class="text-danger">{{$errors->first('mn_name') }}  </p>
                    @endif
                </div>

                <a href="{{route('admin.menu.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Quay lại</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Thêm</button>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
