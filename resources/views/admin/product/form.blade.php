<link rel="stylesheet" href="{{ asset('view/css/style.css') }}">

<div class="row">
    <form action="" role="form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cơ bản</h3>
                </div>
                <div class="box-body">
                    <div class="form-group {{$errors->first('pro_name') ?'has-error' : ''}}"><label for="email">Tên sản
                            phẩm</label>
                        <input type="text" class="form-control" name="pro_name" id="email"
                               value="{{  $product->pro_name ?? old('pro_name') }}" placeholder="Áo bóng đá..."
                               autocomplete="off">
                        @if($errors->first('pro_name'))
                            <p class="text-danger">{{ $errors->first('pro_name') }}</p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group {{$errors->first('pro_price') ?'has-error':'' }}">
                                <label for="pass">Giá sản phẩm</label>
                                <input type="text" class="form-control"
                                       value="{{ $product->pro_price ?? old('pro_price') }}" name="pro_price" id="pass"
                                       placeholder="2.000.000" autocomplete="off">
                                @if($errors->first('pro_price'))
                                    <p class="text-danger">{{ $errors->first('pro_price') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="pass">Giảm giá</label>
                                <input type="number" class="form-control" name="pro_sale" id="pass"
                                       value="{{ $product->pro_sale ?? old('pro_sale',0) }}" placeholder="10"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="pass">Số lượng</label>
                                <input type="number" class="form-control" name="pro_amount" id="pass"
                                       value="{{ $product->pro_amount ?? old('pro_amount',0) }}" placeholder="10"
                                       autocomplete="off">
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>

                        <div class="col-md-12" style="margin-bottom:20px">
                            @if(isset($image))
                                <div class="row">
                                    @foreach($image as $item)
                                        <div class="col-sm-2 position-relative" style="margin: 10px;">
                                            <div class="remove" style="width: 25px;height: 25px;background: red;border-radius: 50%;color: black;position: absolute;display: flex;justify-content: center;margin-top: -10px;margin-left: -15px;cursor:poiter">
                                            <a href="{{ route('admin.product.delete_image',$item->id)}}">
                                                    <i class="fa fa-trash-o" style="color: white;padding-top:5px"></i>
                                            </a>
                                            </div>
                                            <a
                                                    href="javascript:;"
                                                    style="display:block">
                                                <img src="{{ pare_url_file($item->al_slug)}}"
                                                     style="width:100px;height:100px;object-fit:cover"></a></div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="box-header with-border">
                                <h3 class="box-title">Album ảnh</h3>
                                <input type="file" class="file" name="file[]" id="images" multiple>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="da">Từ khóa mới</label><br>
                                <input type="text" data-role="tagsinput" class="form-control" id="da" name="keywordseo"
                                       value="{{ $product->keywordseo ?? old('keywordseo','') }}">

                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="fs" class="control-label">Từ khóa có sẵn <b class="col-red">(*)</b></label>
                                <select name="keywords[]" id="fs" class="form-control js-select2-keyword" multiple="">

                                    @foreach($keywords as $listcate)
                                        <option value="{{ $listcate->id }}" {{ in_array($listcate->id,$keywordOld) ? "selected='selected'" : "" }}>
                                            {{$listcate ->k_name}}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group {{$errors->first('pro_description') ?'has-error':''}}">
                                <label for="des">Mô tả</label>
                                <textarea name="pro_description" id="des" cols="5" rows="2" autocomplete="off"
                                          class="form-control">{{$product->pro_description ?? old('pro_description',"Đang cập nhật")}}</textarea>
                                @if($errors->first('pro_description'))
                                    <p class="text-danger">{{ $errors->first('pro_description') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fs" class="control-label">Danh mục <b class="col-red">(*)</b></label>
                        <select name="pro_category" id="fs" class="form-control">
                            @foreach($category as $listcate)
                                <option value="{{ $listcate->id }}" {{ ($product->pro_category ?? '') == $listcate->id ? "selected='selected'" :""}}>
                                    {{$listcate ->c_name}}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->first('pro_category'))
                            <p class="text-danger">{{ $errors->first('pro_category') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Nội dung</h3>
                </div>
                <div class="box-body">
                    <div class="form-group {{$errors->first('pro_content') }}">
                        <textarea name="pro_content"
                                  id="content">{{ $product->pro_content ?? old('pro_content',"Content") }}</textarea>
                        @if($errors->first('pro_content'))
                            <p class="text-danger">{{ $errors->first('pro_content') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Ảnh đại diện</h3>
                </div>
                <div class="box-body block-images">
                    <div style="margin-bottom: 10px" class="image-area">
                        <img src="{{ $product->pro_avatar ?? asset('view/img/no-image.png') }}" class="img-thumbnail">
                    </div>
                    <!-- <div style="position:relative;"> <a class="btn btn-primary" href="javascript:;"> Choose File...
                    <input type="file" name="pro_avatar" size="40" class="d-none js-upload"> </a> &nbsp; <span class="label label-info" id="upload-file-info"></span> </div> -->
                    <label for="thumbnail-stage" class="btn btn-primary">Choose File...</label>
                    <input class="imageID d-none" type="file" id="thumbnail-stage" name="thumbnail_stage" style="display:none"
                           accept="image/*">
                </div>
            </div>
        </div>
        <div class="col-sm-12 clearfix">
            <div class="box-footer text-center">
                <a href="{{ route('admin.product.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i>Cancel</a>
                <button type="submit" class="btn btn-success"><i
                            class="fa fa-save"></i>{{ isset($product) ?" Cập nhật" :" Thêm mới"}}</button>
            </div>
    </form>
</div>
<script src="{{ asset('view/js/script.js') }}"></script>
