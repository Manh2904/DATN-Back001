<div class="row">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cơ bản</h3>
                </div>
                <div class="box-body">
                    <div class="form-group {{$errors->first('name') ?'has-error' : ''}}">
                        <label for="email">Tên voucher</label>
                        <input type="text" class="form-control" name="name" id="email"
                               value="{{  $voucher->name ?? old('name') }}" placeholder="Tên voucher..."
                               autocomplete="off">
                        @if($errors->first('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->first('amount') ?'has-error':''}}">
                                <label for="des">Giảm giá(%)</label>
                                <input type="text" class="form-control" name="amount" id="email"
                               value="{{  $voucher->amount ?? old('amount') }}" placeholder="Giảm giá(%)..."
                                    autocomplete="off">
                                @if($errors->first('amount'))
                                    <p class="text-danger">{{ $errors->first('amount') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->first('minimum') ?'has-error':''}}">
                                <label for="des">Giá trị tối thiểu</label>
                                <input type="text" class="form-control" name="minimum" id="email"
                               value="{{  $voucher->minimum ?? old('minimum') }}" placeholder="Giá trị tối thiểu..."
                                    autocomplete="off">
                                @if($errors->first('minimum'))
                                    <p class="text-danger">{{ $errors->first('minimum') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->first('maximum') ?'has-error':''}}">
                                <label for="des">Giá trị tối đa</label>
                                <input type="text" class="form-control" name="maximum" id="email"
                               value="{{  $voucher->maximum ?? old('maximum') }}" placeholder="Giá trị tối đa..."
                                    autocomplete="off">
                                @if($errors->first('maximum'))
                                    <p class="text-danger">{{ $errors->first('maximum') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{$errors->first('expired_date') ?'has-error':''}}">
                                <label for="des">Ngày hết hạn</label>
                                <input type="date" class="form-control" name="expired_date" id="email"
                               value="{{  $voucher->expired_date ?? old('expired_date') }}" placeholder="Ngày hết hạn..."
                                    autocomplete="off">
                                @if($errors->first('expired_date'))
                                    <p class="text-danger">{{ $errors->first('expired_date') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-12 clearfix">
            <div class="box-footer text-center">
                <a href="{{ route('admin.voucher.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i>Quay
                    lại</a>
                <button type="submit" class="btn btn-success"><i
                            class="fa fa-save"></i>{{ isset($voucher) ?" Cập nhật" :" Thêm mới"}}</button>
            </div>
    </form>
</div>
