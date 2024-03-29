@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Thêm thương hiệu mới</h1>
            <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
                +
            </a>
        </div>
        <form action="/admin/brand/add" method="POST">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card" style="padding-top: -2px;">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tên</h5>
                        </div>
                        <div class="card-body" style="margin-top: -20px; margin-bottom: 40px;">
                            <input type="text" class="form-control" placeholder="Tên thương hiệu" name="name">
                        </div>
                        @if ($errors->first('name') != '')
                        <ul style="margin-top:-45px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('name') }}</li>
                        </ul>
                        @endif

                    </div>
                    <div class="card">
                        <div class="card-header" style="padding-top:20px; ">
                            <h5 class="card-title mb-0">Hình ảnh thương hiệu</h5>
                        </div>
                        <div class="card-body" style="margin-top: -10px;padding-bottom: 60px;">
                            <input type="file" name="file" class="form-control" id="upload">
                            <div id="image_show" style="margin-top: 15px;"></div>
                            <input type="hidden" name="image" id="thumb">

                        </div>
                        @if ($errors->first('image') != '')
                        <ul style="margin-top:-60px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('image') }}</li>
                        </ul>
                        @endif

                    </div>


                </div>

                <div class="col-12 col-lg-6">

                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Mô tả</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" name="description" class="form-control" placeholder="Thêm mô tả ngắn">
                        </div>
                        @if ($errors->first('description') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('description') }}</li>
                        </ul>
                        @endif

                        <div class="card-header">
                            <h5 class="card-title mb-0">Quốc gia</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" name="country" class="form-control"
                                placeholder="Tên quốc gia của thương hiệu">
                        </div>
                        @if ($errors->first('country') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('country') }}</li>
                        </ul>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Kích hoạt</h5>
                        </div>
                        <div class="card-body" style="margin-top: -20px;">
                            <div>
                                <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                                    checked="true">
                                <label for="active" class="custom-control-label">Có</label>
                            </div>
                            <div>
                                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                                <label for="no_active" class="custom-control-label">Không</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Thêm thương hiệu</button>
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
