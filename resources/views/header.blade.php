<header>
    <!-- Begin Header Top Area -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Begin Header Top Left Area -->
                <div class="col-lg-3 col-md-4">
                    <div class="header-top-left">
                        <ul class="phone-wrap">
                            <li><span>Số điện thoại đặt hàng:</span><a href="#"> (+84) 911603179</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top Left Area End Here -->
                <!-- Begin Header Top Right Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="header-top-right">
                        <ul class="ht-menu">
                            <!-- Begin Setting Area -->
                              @if (session('user'))
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                     <img src="{{ session('user')->avatar; }}" style="height: 23px; width: 23px; border-radius: 50%;" class="avatar img-fluid me-1" alt="Charles Hall" /> <span class="text-dark">{{ session('user')->name}}</span>
                         </a>
                @else 
                              <li>
                                <a href="/register" style="color: #0b0b0b;"><span>Đăng ký</span></a>
                            </li>
                            <li>
                                <a href="/login" style="color: #0b0b0b;"><span>Đăng nhập</span></a>
                            </li>
                @endif
            
                <div class="dropdown-menu dropdown-menu-end" style="font-size: 13px;">
                    <a class="dropdown-item" href="pages-profile.html"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user align-middle me-1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Thông tin cá nhân</a>
                    <a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart align-middle me-1"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg> Phân tích</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.html"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings align-middle me-1"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> Cài đặt</a>
                    <a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle align-middle me-1"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> Trợ giúp</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">Đăng xuất</a>
                </div>
                         
                      <!--      <li>
                                <div class="ht-setting-trigger"><span>Setting</span></div>
                                <div class="setting ht-setting">
                                    <ul class="ht-setting-list">
                                        <li><a href="login-register.html">My Account</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="login-register.html">Sign In</a></li>
                                    </ul>
                                </div>
                            </li> -->
                            <!-- Currency Area End Here -->
                            <!-- Begin Language Area -->
                            <li>
                                <span class="language-selector-wrapper">Ngôn ngữ :</span>
                                <div class="ht-language-trigger"><span>Tiếng Việt</span></div>
                                <div class="language ht-language">
                                    <ul class="ht-setting-list">
                                        <li ><a href="#"><img src="../public/images/menu/flag-icon/1.jpg" alt="">English</a></li>
                                        <li class="active"><a href="#"><img src="../public/images/menu/flag-icon/2.jpg" alt="">Tiếng Việt</a></li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Language Area End Here -->
                        </ul>
                    </div>
                </div>
                <!-- Header Top Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Top Area End Here -->
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->

                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="index.html">
                            <img src="{{asset('images/allo.png')}}" style="height: 85px;width: 250px; margin-top: -20px;margin-left: 10px;" alt="">
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    <form action="#" class="hm-searchbox">
                        <select class="nice-select select-search-category">
                            <option value="0">All</option>                         
                            <option value="10">Mỏng nhẹ</option>
                            <option value="47">Chơi game</option>
                            <option value="48">- - - -  Xiaomi</option>
                            <option value="49">- - - -  Samsung</option>
                            <option value="50">- - - -  Iphone</option>
                            <option value="51">- - - -  LG</option>
                            <option value="78">- - - -  Màn hình gập</option>
                        </select>
                        <input type="text" placeholder="Nhập để tìm sản phẩm ...">
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart">
                                <div class="hm-minicart-trigger">
                                    <span class="item-icon"></span>
                                    <span class="item-text">0Đ
                                        <span class="cart-item-count">0</span>
                                    </span>
                                </div>
                                <span></span>
                                <div class="minicart">
                                    <ul class="minicart-product-list">
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                    </ul>
                                    <p class="minicart-total">TỔNG CỘNG: <span>0Đ</span></p>
                                    <div class="minicart-button">
                                        <a href="shopping-cart.html" class="li-button li-button-fullwidth li-button-dark">
                                            <span>Xem giỏ hàng</span>
                                        </a>
                                        <a href="checkout.html" class="li-button li-button-fullwidth">
                                            <span>Thanh toán</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>
                            <ul class="d-flex">
                                <li><a href="/" >TRANG CHỦ</a></li>

                                <li class="megamenu-holder"><a href="shop-left-sidebar.html" >ĐIỆN THOẠI</a>
                                    <ul class="megamenu hb-megamenu">
                                        <li><a href="shop-left-sidebar.html">Hãng sản xuất</a>
                                            <ul>
                                                <li><a href="shop-3-column.html">Samsung</a></li>
                                                <li><a href="shop-4-column.html">Apple</a></li>
                                                <li><a href="shop-left-sidebar.html">Xiaomi</a></li>
                                                <li><a href="shop-right-sidebar.html">Vivo</a></li>
                                                <li><a href="shop-list.html">Oppo</a></li>
                                                <li><a href="shop-list-left-sidebar.html">LG</a></li>
                                                <li><a href="shop-list-right-sidebar.html">VSmart</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="single-product-gallery-left.html">Mức giá</a>
                                            <ul>
                                                <li><a href="single-product-carousel.html">Dưới 2 triệu</a></li>
                                                <li><a href="single-product-gallery-left.html">Từ 2 đến 4 triệu</a></li>
                                                <li><a href="single-product-gallery-right.html">Từ 4 đến 7 triệu</a></li>
                                                <li><a href="single-product-tab-style-top.html">Từ 7 đến 13 triệu</a></li>
                                                <li><a href="single-product-tab-style-left.html">Từ 13 đến 20 triệu</a></li>
                                                <li><a href="single-product-tab-style-right.html">Trên 20 triệu</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="single-product.html">Theo nhu cầu</a>
                                            <ul>
                                                <li><a href="single-product.html">Mỏng nhẹ</a></li>
                                                <li><a href="single-product-sale.html">Thời thượng</a></li>
                                                <li><a href="single-product-group.html">Chơi game</a></li>
                                                <li><a href="single-product-normal.html">Chụp ảnh, quay phim</a></li>
                                                <li><a href="single-product-affiliate.html">Tính năng đặc biệt</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-holder" ><a href="blog-left-sidebar.html">BÀI VIẾT</a>
                                    <ul class="hb-dropdown">
                                        <li class="sub-dropdown-holder"><a href="blog-left-sidebar.html">Mới nhất</a>
                                            <ul class="hb-dropdown hb-sub-dropdown">
                                                <li><a href="blog-2-column.html">Mới nhất</a></li>
                                                <li><a href="blog-3-column.html">Sản phẩm mới</a></li>
                                                <li><a href="blog-left-sidebar.html">Đánh giá</a></li>
                                                <li><a href="blog-right-sidebar.html">Tư vấn</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-dropdown-holder"><a href="blog-list-left-sidebar.html">Sản phẩm mới</a>

                                        </li>
                                        <li class="sub-dropdown-holder"><a href="blog-details-left-sidebar.html">Đánh giá</a>
                                        </li>
                                        <li class="sub-dropdown-holder"><a href="blog-gallery-format.html">Tư vấn</a>
                                        </li>
                                    </ul>
                                </li>
                                <li style="margin-right: 20px;"><a href="about-us.html">VỀ WEBSITE</a></li>
                                <li><a href="contact.html">LIÊN HỆ</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container"> 
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>