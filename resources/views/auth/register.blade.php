  @extends('index')
  @section('content')
      <!-- Begin Li's Breadcrumb Area -->
      <div class="breadcrumb-area">
          <div class="container">
              <div class="breadcrumb-content">
                  <ul>
                      <li><a href="index.html">Trang chủ</a></li>
                      <li class="active">Đăng nhập</li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- Li's Breadcrumb Area End Here -->
      <!-- Begin Login Content Area -->
      <div class="page-section mt-60 mb-60">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                      <form action="/register" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="login-form">
                              <h4 class="login-title">Đăng ký</h4>
                              @if (session('email-errors'))
                                  <ul style="margin-bottom:25px; ">
                                      <li class="text-danger"> {{ session('email-errors') }}</li>
                                  </ul>
                              @endif
                              <div class="row">
                                  <div class="col-md-6 col-12 mb-20">
                                      <label>Họ và tên</label>
                                      <input class="mb-0" type="text" name="full_name" placeholder="Họ và tên">
                                      <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('full_name')}}</li>
                                      </ul>
                                  </div>
                                  <div class="col-md-6 col-12 mb-20">
                                      <label>Số điện thoại</label>
                                      <input class="mb-0" type="text" name="phone" placeholder="Số điện thoại">
                                      <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('phone')}}</li>
                                      </ul>
                                  </div>
                                  <div class="col-md-12 mb-20">
                                      <label>Email</label>
                                      <input class="mb-0" type="email" name="gmail" placeholder="Email">
                                       <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('gmail')}}</li>
                                      </ul>
                                  </div>
                                  <div class="col-md-6 mb-20">
                                      <label>Mật khẩu</label>
                                      <input class="mb-0" type="password" name="pass" placeholder="Mật khẩu">
                                       <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('pass')}}</li>
                                      </ul>
                                  </div>
                                  <div class="col-md-6 mb-20">
                                      <label>Xác nhận mật khẩu</label>
                                      <input class="mb-0" type="password" name="re-pass"
                                          placeholder="Xác nhận mật khẩu">
                                     <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('re-pass')}}</li>
                                      </ul>
                                  </div>
                                  <div class="col-12">
                                      <button class="register-button mt-0" type="submit">Đăng kí</button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- Login Content Area End Here -->
  @endsection
