@extends('admin.main')
@section('content')
<main class="content">
   <div class="container rounded bg-white">
    <div class="col-md-12 border" style="padding: 20px;">
        <form action="/admin/change-password/{{ $admin->id }}" method="post">
            {{ csrf_field() }}
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="text-right" style="font-weight: bold;">Đổi Mật Khẩu</h2>

                </div>
                <label class="labels mb-5">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</label>
                <hr >
                <div class="row mt-5">
                    <div class="col-md-3 mb-5"><label class="labels">Mật khẩu hiện tại</label>
                    </div>
                    <div class="col-md-6">
                        <input type="password" name="current_password" class="form-control"
                        >
                        @if($errors->first('current_password') != '')

                            <p class="text-danger mt-2">{{$errors->first('current_password')}}</p>
                        @endif
                    </div>
                </div>
                <div class="row mt-2 mb-5">

                    <div class="col-md-3"><label class="labels">Mật khẩu mới</label>
                    </div>
                    <div class="col-md-6">
                        <input type="password" name="new-pass" class="form-control" >
                        @if($errors->first('new-pass') != '')
                       <p class="text-danger mt-2">{{$errors->first('new-pass')}}</p>
                        @endif
                    </div>
                </div>
                <div class="row mt-2">

                    <div class="col-md-3"><label class="labels">Xác nhận mật khẩu</label>
                    </div>
                    <div class="col-md-6">
                        <input type="password" name="re-new-pass" class="form-control">
                        @if($errors->first('re-new-pass') != '')
                       <p class="text-danger mt-2">{{$errors->first('re-new-pass')}}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-5 text-center">
                    @csrf
                    <button class="btn btn-primary" style="background-color: #ee4d2d; border: none;" type="submit">Cập
                        nhật thông tin</button>
                </div>
            </div>
        </form>
    </div>
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
