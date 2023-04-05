@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Thêm nhà cung cấp</h1>
        </div>
        <form action="/admin/suppliers/add" method="POST">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tên nhà cung cấp</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" class="form-control" placeholder="Tên nhà cung cấp..." name="name">
                        </div>
                        @if ($errors->first('name') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('name') }}</li>
                        </ul>
                        @endif
                        <div class="card-header">
                            <h5 class="card-title mb-0">Email</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" class="form-control" placeholder="Nhập email..." name="email">
                        </div>
                        @if ($errors->first('email') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('email') }}</li>
                        </ul>
                        @endif
                        <div class="card-header">
                            <h5 class="card-title mb-0">Số điện thoại</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" class="form-control" placeholder="số điện thoại..." name="phone">

                        </div>
                        @if ($errors->first('phone') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('phone') }}</li>
                        </ul>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <!-- select -->
                        <div class="card-header">
                            <h5 class="card-title mb-0">Địa chỉ</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" class="form-control" placeholder="Địa chỉ nhà cung cấp..." name="address">
                        </div>
                        @if ($errors->first('address') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('address') }}</li>
                        </ul>
                        @endif
                        <div class="card-header" style="margin-top: 12px;">
                            <h5 class="card-title mb-0">Trạng thái</h5>
                        </div>
                       <div class="card-body" style="margin-top: -12px;">
                        <div>
                            <input class="custom-control-input" value="1" type="radio" id="active" name="status" checked="true">
                            <label for="active" class="custom-control-label">Hợp tác</label>
                        </div>
                        <div style="margin-top: 10px; margin-bottom: 57px;">
                            <input class="custom-control-input" value="0" type="radio" id="no_active" name="status">
                            <label for="no_active" class="custom-control-label">Ngừng hợp tác</label>
                        </div>
                    </div>


                    </div>
                </div>
            </div>
            <div class="card-footer" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Thêm nhà cung cấp</button>
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
