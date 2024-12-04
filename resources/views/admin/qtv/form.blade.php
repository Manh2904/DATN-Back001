<div class="row">
    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cơ bản</h3>
                </div>
                <div class="box-body">
                    <div class="form-group {{$errors->first('name') ?'has-error' : ''}}">
                        <label for="name">Tên quản trị viên</label>
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{  $qtv->name ?? old('name') }}" placeholder="Tên quản trị viên..."
                               autocomplete="off">
                        @if($errors->first('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->first('email') ?'has-error':''}}">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                               value="{{  $qtv->email ?? old('email') }}" placeholder="Email..."
                                    autocomplete="off">
                                @if($errors->first('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->first('password') ?'has-error':''}}">
                                <label for="pwd">Mật khẩu</label>
                                <input type="password" class="form-control" id="pwd" name="password" autocomplete="off">
                                @if($errors->first('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->first('password_confirmation') ?'has-error':''}}">
                                <label for="password_confirmation">Xác nhận mật khẩu</label>
                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                                    autocomplete="off">
                                @if($errors->first('password_confirmation'))
                                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-12 clearfix">
            <div class="box-footer text-center">
                <a href="{{ route('admin.qtv.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i>Quay
                    lại</a>
                <button type="submit" class="btn btn-success"><i
                            class="fa fa-save"></i>{{ isset($qtv) ?" Cập nhật" :" Thêm mới"}}</button>
            </div>
    </form>
</div>
