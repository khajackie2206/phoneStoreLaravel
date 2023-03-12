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
                  <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                      <!-- Login Form s-->
                      <form action="/login" method="post">
                          {{ csrf_field() }}
                          <div class="login-form">
                              <h4 class="login-title">Đăng nhập</h4>
                              @if (session('status'))
                                  <ul style="margin-bottom:25px; ">
                                      <li class="text-danger"> {{ session('status') }}</li>
                                  </ul>
                              @endif
                              <div class="row">
                                  <div class="col-md-12 col-12 mb-20">
                                      <label>Email</label>
                                      <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                       <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('email')}}</li>
                                      </ul>
                                  </div>
                                  <div class="col-12 mb-20">
                                      <label>Mật khẩu</label>
                                      <input class="mb-0" type="password" name="password" placeholder="Password">
                                       <ul style="margin-top:5px; ">
                                          <li class="text-danger">{{$errors->first('password')}}</li>
                                      </ul>
                                  </div>
                                  <div class="col-md-8">
                                      <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                          <input type="checkbox" id="remember_me">
                                          <label for="remember_me">Lưu thông tin</label>
                                      </div>
                                  </div>
                                  <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                      <a href="/users/forget-password"> Quên mật khẩu?</a>
                                  </div>

                                  @if (isset($url))
                                       <input type="hidden" value="{{ $url }}" name="url">
                                  @endif
                                  <div class="col-md-4">
                                      <button class="register-button mt-0" type="submit">Đăng nhập</button>
                                  </div>
                                  <div class="col-md-8 d-flex justify-content-end">
                                      <a href="google"  class="google-login" type="submit"><img src="https://storage.googleapis.com/support-kms-prod/ZAl1gIwyUsvfwxoW9ns47iJFioHXODBbIkrK" width="16px" style="margin-right: 7px;"><span style="color: #363f4d;">Đăng nhập với google</span></a>
                                  </div>

                                  <div class="col-md-12 mt-20 text-left text-md-left">
                                       <span style="color: #a5a5a5;">Bạn chưa có tài khoản?</span><a href="/register" style="color: #ee4d2d;"> Đăng ký</a>
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
