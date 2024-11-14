@extends('layout.admin')
@section('content')
    <title>Thay đổi thông tin sản phẩm</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thay đổi thông tin sản phẩm
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index') }}"> Home</a></li>
                <li><a href="{{ route('admin.attribute.index') }}">Attribute</li>
                >
                <li><a href="#">Add</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="" method="POST" role="form" class="col-md-8">
                @csrf
                <div class="form-group {{ $errors->first('atb_name') ? ' has-error':'' }}">
                    <label for="exampleInputEmail1">Thuộc tính</label>
                    <input type="text" name="atb_name" value="{{ $attributes->atb_name }}" class="form-control"
                           id="exampleInputEmail1">
                    @if ($errors->first('atb_name'))
                        <p class="text-danger">{{$errors->first('atb_name') }}  </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->first('atb_type') ? ' has-error':'' }}">
                    <label for="exampleInputEmai1">Group</label>

                    <select class="form-control" name="atb_type" id="exampleInputEmai1">
                        <option value="">--Chọn thể loại--</option>

                        <option value="1" {{ $attributes->atb_type == 1 ? "selected='selected'" : ''}}>Đôi</option>
                        <option value="2" {{ $attributes->atb_type == 2 ? "selected='selected'" : ''}}>Năng lượng
                        </option>
                        <option value="3" {{ $attributes->atb_type == 3 ? "selected='selected'" : ''}}>Loại dây</option>
                        <option value="4" {{ $attributes->atb_type == 4 ? "selected='selected'" : ''}}>Loại vỏ</option>
                    </select>
                    @if ($errors->first('atb_type'))
                        <p class="text-danger">{{$errors->first('atb_type') }}  </p>
                    @endif
                </div>

                <div class="form-group {{ $errors->first('atb_category_id') ? ' has-error':'' }}">
                    <label for="exampleInputEmai1">Group</label>
                    <select class="form-control" name="atb_category_id" id="exampleInputEmai1">
                        <option value="">--Category Id--</option>
                        @foreach($category as $cate)
                            <option value="{{ $cate->id}}" {{ $attributes->atb_category_id == $cate->id ? "selected='selected'" :'' }}>{{ $cate->c_name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->first('atb_category_id'))
                        <p class="text-danger">{{$errors->first('atb_category_id') }}  </p>
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
