@extends('index')
@section('content')
<div class="container rounded bg-white mt-70 mb-70">
    <div class="col-md-12 border">
        <form action="{{ route('reset.password.post') }}" method="post">
           @csrf
           <input type="hidden" name="token" value="{{ $token }}">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-right">Phục hồi mật khẩu</h3>

                </div>
                <label class="labels">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</label>
                <hr>
                <div class="row mt-2">
                    <div class="col-md-3"><label class="labels">Địa chỉ email</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="email_address" name="email" class="form-control"
                           required autofocus >
                       @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mt-2">

                    <div class="col-md-3"><label class="labels">Mật khẩu mới</label>
                    </div>
                    <div class="col-md-6">
                        <input type="password" id="password" name="password" class="form-control" required autofocus>
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mt-2">

                    <div class="col-md-3"><label class="labels">Xác nhận mật khẩu</label>
                    </div>
                    <div class="col-md-6">
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required autofocus>
                        @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mt-30 text-center">
                    @csrf
                    <button class="btn btn-primary" style="background-color: #ee4d2d; border: none;" type="submit">Cập
                        nhật mật khẩu</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
