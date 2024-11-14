@extends('layout.admin')
@section('content')
    <title>Sửa thông tin từ khóa</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa thông tin từ khóa
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index') }}"> Home</a></li>
                <li><a href="{{ route('admin.keyword.index') }}">Keyword</li>
                >
                <li><a href="#"> Edit </a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="" method="POST" role="form" class="col-md-8">
                @csrf
                <div class="form-group {{ $errors->first('k_name') ? ' has-error':'' }}">
                    <label for="exampleInputEmail1">Từ khóa</label>
                    <input type="text" name="k_name" class="form-control" id="exampleInputEmail1"
                           value="{{$keyword->k_name}}" aria-describedby="emailHelp">
                    @if ($errors->first('k_name'))
                        <p class="text-danger">{{$errors->first('k_name') }}  </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->first('k_description') ? ' has-error':'' }}">
                    <label for="exampleInputEmail">Mô tả</label>
                    <input type="text" name="k_description" class="form-control" id="exampleInputEmail"
                           value="{{$keyword->k_description}}" aria-describedby="emailHelp">
                    @if ($errors->first('k_description'))
                        <p class="text-danger">{{$errors->first('k_description') }}  </p>
                    @endif
                </div>
                <a href="{{route('admin.keyword.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Quay
                    lại</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Sửa</button>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
