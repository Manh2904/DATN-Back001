@extends('layout.admin')
@section('content')
    <title>Thay đổi thông tin biến thể</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thay đổi thông tin biến thể
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index') }}"> Trang chủ</a></li>
                <li><a href="{{ route('admin.attribute.index') }}">Biến thể</li>
                >
                <li><a href="#">Cập nhật</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="" method="POST" role="form" class="col-md-8">
                @csrf
                <div class="form-group {{ $errors->first('name') ? ' has-error':'' }}">
                    <label for="exampleInputEmail1">Thuộc tính</label>
                    <input type="text" name="name" value="{{ $attributes->name }}" class="form-control"
                           id="exampleInputEmail1">
                    @if ($errors->first('name'))
                        <p class="text-danger">{{$errors->first('name') }}  </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->first('menu_id') ? ' has-error':'' }}">
                    <label for="exampleInputEmai1">Group</label>
                    <select class="form-control" name="menu_id" id="exampleInputEmai1">
                        @foreach($menu as $cate)
                            <option value="{{ $cate->id}}" {{ $attributes->menu_id == $cate->id ? "selected='selected'" :'' }}>{{ $cate->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->first('menu_id'))
                        <p class="text-danger">{{$errors->first('menu_id') }}  </p>
                    @endif
                </div>

                <a href="{{route('admin.attribute.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Quay lại</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
