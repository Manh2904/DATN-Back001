@extends('layout.admin')
@section('content')
    <title>Hủy đơn hàng</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Hủy đơn hàng # {{ $transaction->id}}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="" method="POST" role="form" class="col-md-8">
                @csrf
                <div class="form-group {{ $errors->first('description_cancel') ? ' has-error':'' }}">
                    <label for="exampleInputEmail1">Lý do hủy đơn hàng</label>
                    <input type="text" name="description_cancel" class="form-control" id="exampleInputEmail1"
                           required>
                    @if ($errors->first('description_cancel'))
                        <p class="text-danger">{{$errors->first('description_cancel') }}  </p>
                    @endif
                </div>

                <a href="{{route('admin.transaction.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Quay lại</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
