@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Thêm thương khuyến mãi mới</h1>
            <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
                +
            </a>
        </div>
        <form action="/admin/brand/add" method="POST">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card" style="padding-bottom: 40px;">
                        <div class="card-header" style="padding-top: 5px;">
                            <h5 class="card-title mb-0">Tên khuyến mãi</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" placeholder="Tên khuyến mãi" name="name">

                        </div>
                        @if ($errors->first('name') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('name') }}</li>
                        </ul>
                        @endif
                        <div class="card-header" style="padding-top: 5px;">
                            <h5 class="card-title mb-0">Mã khuyến mãi</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" placeholder="Nhập mã khuyến mãi" name="code">

                        </div>
                        @if ($errors->first('name') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('name') }}</li>
                        </ul>
                        @endif
                        <div class="card-header" style="padding-top: 5px;">
                            <h5 class="card-title mb-0">Số lượng của khuyến mãi</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" placeholder="Nhập số lượng mã khuyến mãi"
                                name="quantity">

                        </div>
                        @if ($errors->first('name') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('name') }}</li>
                        </ul>
                        @endif

                        <div class="card-header" style="padding-top: 5px;">
                            <h5 class="card-title mb-0">Ngày bắt đầu</h5>
                        </div>
                    <h3 class="pt-4 pb-2">Bootstrap Datepicker</h3>
<section class="col-sm-12">
    <div class="form-group">
        <div class='input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>

</section>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <!-- select -->
                        <div class="card-header">
                            <h5 class="card-title mb-0">Loại giảm giá</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                        <div class="card-header">
                            <h5 class="card-title mb-0">Giá trị của khuyến mãi</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" name="description" class="form-control"
                                placeholder="Nhập giá trị của khuyến mãi">
                        </div>


                        @if ($errors->first('description') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('description') }}</li>
                        </ul>
                        @endif

                        <div class="card-header">
                            <h5 class="card-title mb-0">Thời gian khuyến mãi</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" name="country" class="form-control"
                                placeholder="Tên quốc gia của thương hiệu">
                        </div>
                        @if ($errors->first('country') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('country') }}</li>
                        </ul>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Kích hoạt</h5>
                        </div>
                        <div class="card-body">
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
         alert(2);
</script>
<script type="text/javascript">
    $(function() {
            $('#datetimepicker1').datetimepicker();
        });
</script>

@endsection

