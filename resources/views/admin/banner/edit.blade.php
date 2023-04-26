@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Cập nhật thông tin banner</h1>
        </div>
        <form action="/admin/banner/edit/{{ $banner->id }}" method="POST">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Tiêu đề</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" value="{{ $banner->header }}"
                                placeholder="Tên tiêu đề banner" name="header">

                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('header') != '')
                        <ul style="margin-top:-15px; list-style-type:none;">
                            <li class="text-danger">{{ $errors->first('header') }}
                            </li>
                        </ul>
                        @endif
                    </div>
                        <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Tên sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" value="{{ $banner->product_name }}"
                                placeholder="Tên sản phẩm quảng bá" name="product_name">
                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('product_name') != '')
                        <ul style="margin-top:-15px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('product_name') }}</li>
                        </ul>
                        @endif
                    </div>
                        <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Giá</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" value="{{ $banner->price }}"
                                placeholder="Giá của sản phẩm quảng bá" name="price">
                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('price') != '')
                        <ul style="margin-top:-15px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('price') }}</li>
                        </ul>
                        @endif
                    </div>

                        <div class="card-header">
                            <h5 class="card-title mb-0">Hình ảnh banner</h5>
                        </div>
                        <div class="card-body" style="margin-top: -25px;">
                            <input type="file" name="file" class="form-control" id="upload">
                            <div id="image_show" style="margin-top: 15px;height: 60px;">
                                <a href="{{ $banner->thumb }}"><img src="{{ $banner->thumb }}" width="100px"></a>
                            </div>
                            <input type="hidden" name="thumb" value="{{ $banner->thumb }}" id="thumb">

                        </div>
                        @if ($errors->first('thumb') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('thumb') }}</li>
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Loại banner</h5>
                        </div>
                        <div class="card-body">
                            <select class="form-select mb-1" name="type_banner">
                                <option value="header" {{ $banner->type_banner == "header" ? 'selected' : '' }}>Tiêu đề
                                </option>
                                <option value="header static" {{ $banner->type_banner == "header static" ? 'selected' :
                                    '' }}>Tiêu đề tĩnh</option>
                                <option value="center static" {{ $banner->type_banner == "center static" ? 'selected' :
                                    '' }}>Giữa Tĩnh</option>
                                <option value="broadcast" {{ $banner->type_banner == "broadcast" ? 'selected' : ''
                                    }}>Quảng bá</option>
                            </select>
                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('type_banner') != '')
                        <ul style="margin-top:-12px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('type_banner') }}</li>
                        </ul>
                        @endif
                        </div>
                        <div class="card-header">
                            <h5 class="card-title mb-0">Đường dẫn</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" name="url" class="form-control" value="{{ $banner->url }}"
                                placeholder="Đường dẫn đến sản phẩm quảng bá">
                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('url') != '')
                        <ul style="margin-top:-12px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('url') }}</li>
                        </ul>
                        @endif
                        </div>

                        <div class="card-header">
                            <h5 class="card-title mb-0">Thứ tự banner</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" name="order" value="{{ $banner->sort_by}}" class="form-control"
                                placeholder="Thứ tự hiển thị banner" disabled>
                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('order') != '')
                        <ul style="margin-top:-12px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('order') }}</li>
                        </ul>
                        @endif
                        </div>
                        <div class="card-header" style="margin-top: 20px;">
                            <h5 class="card-title mb-0">Kích hoạt</h5>
                        </div>
                        <div class="card-body" style="margin-top: -15px;">
                            <div>
                                <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                                    {{$banner->active == 1 ? 'checked="true"' : '' }}>
                                <label for="active" class="custom-control-label">Có</label>
                            </div>
                            <div style="margin-bottom: 35px;">
                                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                                    {{$banner->active == 0 ? 'checked="true"' : '' }}>
                                <label for="no_active" class="custom-control-label">Không</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="text-align: center;">
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Cập nhật</button>
            </div>
            @csrf
        </form>
    </div>
</main>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection
