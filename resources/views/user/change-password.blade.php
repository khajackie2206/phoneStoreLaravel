@extends('index')
@section('content')
<div class="container rounded bg-white mt-70 mb-70">
    <div class="col-md-12 border">
          <form action="/users/change-password/{{ $user->id }}" method="post">
               {{ csrf_field() }}
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="text-right">Đổi Mật Khẩu</h3>

                        </div>
                        <label class="labels">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</label>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-md-3"><label class="labels">Mật khẩu hiện tại</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="current_password" class="form-control" value="123456"
                                    placeholder="">
                                     <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('current_password')}}</li>
                                      </ul>
                            </div>
                        </div>
                        <div class="row mt-2">

                            <div class="col-md-3"><label class="labels">Mật khẩu mới</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="new-pass" class="form-control" value="123456"
                                    placeholder="">
                                     <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('new-pass')}}</li>
                                      </ul>
                            </div>
                        </div>
                         <div class="row mt-2">

                            <div class="col-md-3"><label class="labels">Xác nhận mật khẩu</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="re-new-pass" class="form-control" value="123456"
                                    placeholder="">
                                     <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('re-new-pass')}}</li>
                                      </ul>
                            </div>
                        </div>

                        <div class="mt-3 text-center">
                            @csrf
                            <button class="btn btn-primary" style="background-color: #ee4d2d; border: none;" type="submit">Cập nhật thông tin</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>

@endsection
