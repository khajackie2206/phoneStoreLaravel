@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Thêm nhân viên mới</h1>
        </div>
        <form action="/admin/staffs/add" method="POST">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tên nhân viên</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" class="form-control" placeholder="Tên nhân viên" name="name">

                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('name') != '')
                        <ul style="margin-top:-12px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('name') }}</li>
                        </ul>
                        @endif
                        </div>
                        <div class="card-header">
                            <h5 class="card-title mb-0">Email</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" class="form-control" placeholder="Nhập email" name="email">

                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('email') != '')
                        <ul style="margin-top:-12px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('email') }}</li>
                        </ul>
                        @endif
                        </div>
                        <div class="card-header">
                            <h5 class="card-title mb-0">Số điện thoại</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" class="form-control" placeholder="số điện thoại"
                                name="phone">

                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('phone') != '')
                        <ul style="margin-top:-12px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('phone') }}</li>
                        </ul>
                        @endif
                    </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <!-- select -->
                        <div class="card-header">
                            <h5 class="card-title mb-0">Mật khẩu</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="password" class="form-control" placeholder="mật khẩu" name="password">
                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('password') != '')
                            <ul style="margin-top:-12px;list-style-type:none; ">
                                <li class="text-danger">{{ $errors->first('password') }}</li>
                            </ul>
                        @endif
                        </div>
                        <div class="card-header">
                            <h5 class="card-title mb-0">Xác nhận mật khẩu</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="xác nhận lại mật khẩu">
                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('password_confirmation') != '')
                        <ul style="margin-top:-12px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('password_confirmation') }}</li>
                        </ul>
                        @endif
                        </div>

                        <div class="card-header">
                            <h5 class="card-title mb-0">Địa chỉ</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" name="address" class="form-control" placeholder="địa chỉ nhân viên">
                        </div>
                        <div style="height:20px;">
                        @if ($errors->first('address') != '')
                        <ul style="margin-top:-12px;list-style-type:none; ">
                            <li class="text-danger">{{ $errors->first('address') }}</li>
                        </ul>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
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
