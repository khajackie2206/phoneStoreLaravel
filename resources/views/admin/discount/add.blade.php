@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Thêm mã khuyến mãi mới</h1>
        </div>
        <form action="/admin/discount/add" method="POST">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card" >
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tên khuyến mãi</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" class="form-control" placeholder="Tên khuyến mãi" name="name">

                        </div>
                        @if ($errors->first('name') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('name') }}</li>
                        </ul>
                        @endif
                        <div class="card-header" >
                            <h5 class="card-title mb-0">Mã khuyến mãi</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" class="form-control" placeholder="Nhập mã khuyến mãi" name="code">

                        </div>
                        @if ($errors->first('code') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('code') }}</li>
                        </ul>
                        @endif
                        <div class="card-header" >
                            <h5 class="card-title mb-0">Số lượng của khuyến mãi</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px; margin-bottom: 15px;">
                            <input type="text" class="form-control" placeholder="Nhập số lượng mã khuyến mãi"
                                name="quantity">

                        </div>
                        @if ($errors->first('quantity') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('quantity') }}</li>
                        </ul>
                        @endif



                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <!-- select -->
                        <div class="card-header">
                            <h5 class="card-title mb-0">Loại giảm giá</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <select class="form-select mb-1" name="type_discount">
                                <option value="percent">giảm theo phần trăm</option>
                                 <option value="money">giảm tiền mặt</option>
                            </select>
                        </div>
                        <div class="card-header">
                            <h5 class="card-title mb-0">Giá trị của khuyến mãi</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" name="amount" class="form-control"
                                placeholder="Nhập giá trị của khuyến mãi">
                        </div>


                        @if ($errors->first('amount') != '')
                        <ul style="margin-top:5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('amount') }}</li>
                        </ul>
                        @endif

                        <div class="card-header">
                            <h5 class="card-title mb-0">Kích hoạt</h5>
                        </div>
                         <div class="card-body" style="margin-top: -22px;">
                            <div>
                                <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="true">
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
                <button type="submit" class="btn btn-primary">Thêm mã</button>
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

