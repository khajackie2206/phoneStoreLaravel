<header>
    <!-- Begin Header Top Area -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Begin Header Top Left Area -->
                <div class="col-lg-4 col-md-4">
                    <div class="header-top-left">
                        <ul class="phone-wrap">
                            <li style="margin-top: 5px;"><a href="#"><i class="fa fa-phone fa-lg" style="color: red;"
                                        aria-hidden="true"></i> +84 911603179<i class="fa fa-envelope fa-lg"
                                        style="margin-left: 40px;color:red;" aria-hidden="true"></i>&nbsp;
                                    khajackie2206@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top Left Area End Here -->
                <!-- Begin Header Top Right Area -->
                <div class="col-lg-8 col-md-8">
                    <div class="header-top-right">
                        <ul class="ht-menu">
                            <!-- Begin Setting Area -->
                            @if (session('user') && !isset(session('user')->role))
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="{{ session('user')->avatar }}"
                                    style="height: 23px; width: 23px; border-radius: 50%;" class="avatar img-fluid me-1"
                                    alt="Charles Hall" /> <span class="text-dark">{{ session('user')->name }}</span>
                            </a>
                            @else
                            <li>
                                <a href="/register" style="color: #0b0b0b;"><span>Đăng ký</span></a>
                            </li>
                            <li>
                                <a href="/login" style="color: #0b0b0b;"><span>Đăng nhập</span></a>
                            </li>
                            @endif

                            <div class="dropdown-menu dropdown-menu-end" style="font-size: 13px; margin-left: 50px;">
                                <a class="dropdown-item" href="/users/detail"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user align-middle me-1">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>&nbsp; Thông tin cá nhân</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/users/order-tracking"><svg version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" width="20px" height="20px" viewBox="0 0 40 36"
                                        style="enable-background:new 0 0 40 36;" xml:space="preserve">
                                        <g id="Page-1_4_" sketch:type="MSPage">
                                            <g id="Desktop_4_" transform="translate(-84.000000, -410.000000)"
                                                sketch:type="MSArtboardGroup">
                                                <path id="Cart" sketch:type="MSShapeGroup" class="st0"
                                                    d="M94.5,434.6h24.8l4.7-15.7H92.2l-1.3-8.9H84v4.8h3.1l3.7,27.8h0.1
			c0,1.9,1.8,3.4,3.9,3.4c2.2,0,3.9-1.5,3.9-3.4h12.8c0,1.9,1.8,3.4,3.9,3.4c2.2,0,3.9-1.5,3.9-3.4h1.7v-3.9l-25.8-0.1L94.5,434.6" />
                                            </g>
                                        </g>
                                    </svg>&nbsp; Đơn hàng</a>

                                @if (!isset(session('user')->provider_name))
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/users/change-password"><img style="height: 23px;"
                                        src="https://img.icons8.com/ios/50/null/re-enter-pincode.png" />&nbsp; Đổi mật
                                    khẩu</a>
                                @endif
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
                            {{-- <li>
                                <span class="language-selector-wrapper">Ngôn ngữ :</span>
                                <div class="ht-language-trigger"><span>Tiếng Việt</span></div>
                                <div class="language ht-language">
                                    <ul class="ht-setting-list">
                                        <li><a href="#"><img src="../public/images/menu/flag-icon/1.jpg"
                                                    alt="">English</a></li>
                                        <li class="active"><a href="#"><img src="../public/images/menu/flag-icon/2.jpg"
                                                    alt="">Tiếng
                                                Việt</a></li>
                                    </ul>
                                </div>
                            </li> --}}
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
                            <img src="{{ asset('images/allo.png') }}"
                                style="height: 85px;width: 250px; margin-top: -20px;margin-left: 10px;" alt="">
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    <form action="#" class="hm-searchbox">

                        <input type="text" name="inputSearch" id="inputSearch"
                            placeholder="Nhập để tìm sản phẩm ...">
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    @php $countProduct = 0; @endphp

                    @if (\Illuminate\Support\Facades\Session::get('carts'))
                    @foreach ($sessionProducts as $sessionProduct)
                    @php $countProduct +=1; @endphp
                    @endforeach
                    @endif
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right" style="margin-left: 20px;">
                        <ul class="hm-menu">
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart">
                                <div class="hm-minicart-trigger">
                                    <span class="item-icon"></span>
                                    <span class="item-text">
                                        <span class="cart-item-count" style="margin-top: 9px;">
                                            {{ $countProduct }}
                                        </span>
                                    </span>
                                </div>
                                <span></span>
                                @php $summary = 0; $discount =0; @endphp
                                <div class="minicart">
                                    <ul class="minicart-product-list">
                                        @if (\Illuminate\Support\Facades\Session::get('carts'))
                                        @foreach ($sessionProducts as $sessionProduct)
                                        @php
                                        $subTotal = ($sessionProduct->discount > 0 ? $sessionProduct->price -
                                        $sessionProduct->discount : $sessionProduct->price) *
                                        $carts[$sessionProduct->id];
                                        $summary += $subTotal;
                                        @endphp
                                        <li>
                                            <a href="single-product.html" class="minicart-product-image">
                                                <img src="{{ $sessionProduct->images->where('type', 'cover')->first()['url'] }}"
                                                    alt="cart products">
                                            </a>
                                            <div class="minicart-product-details">
                                                <h6><a href="single-product.html">{{ $sessionProduct->name }}
                                                         {{ $sessionProduct->ram}} - {{ $sessionProduct->rom}} {{ $sessionProduct->color }}</a>
                                                </h6>
                                                <span><span style="color: red;">{{
                                                        number_format($sessionProduct->discount > 0 ?
                                                        $sessionProduct->price - $sessionProduct->discount :
                                                        $sessionProduct->price) }}</span><span
                                                        style="text-decoration: underline; color:red;">đ</span><span>
                                                        x {{ $carts[$sessionProduct->id] }} </span>
                                            </div>
                                            <button class="close" title="Remove">
                                                <a href="/products/delete-cart/{{ $sessionProduct->id }}">
                                                    <i class="fa fa-close"></i> </a>
                                            </button>
                                        </li>
                                        @endforeach

                                        @endif
                                    </ul>
                                    <p class="minicart-total-2">Giảm giá: <span>@if (Session::get('discount') && Session::get('discount')['type'] == 'money')
                                    <span> - {{ number_format(Session::get('discount')['amount']) }} <span
                                            >đ</span></span>
                                           @php
                                               $discount = Session::get('discount')['amount'];
                                           @endphp
                                    @elseif(Session::get('discount') && Session::get('discount')['type'] == 'percent')
                                    - {{ number_format($summary * (Session::get('discount')['amount'] / 100)) }} Đ
                                    ({{ Session::get('discount')['amount'] }} %)
                                    @php
                                        $discount = $summary * (Session::get('discount')['amount'] / 100);
                                    @endphp
                                    @else
                                    0 <span >đ</span>
                                    @endif</span>
                                    </p>
                                    <p class="minicart-total">TỔNG CỘNG: <span>{{ number_format($summary - $discount) }}Đ</span>
                                    </p>
                                    <div class="minicart-button">
                                        <a href="/products/carts" class="li-button li-button-fullwidth li-button-dark">
                                            <span>Xem giỏ hàng</span>
                                        </a>
                                        <a href="/products/checkout" class="li-button li-button-fullwidth">
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
                <!-- Search product -->
                <div class="row justify-content-center">
                    <div class="col-md-5" style="position:absolute;margin-top:45px;margin-right:1165px; z-index:1;">
                        <div class="list-group" id="show-list">
                        </div>
                    </div>
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
                                <li><a href="/">TRANG CHỦ</a></li>

                                <li class="megamenu-holder"><a href="/products/filter">Bộ lọc</a>
                                    <ul class="megamenu hb-megamenu">
                                        <li><a href="shop-left-sidebar.html">Hãng sản xuất</a>
                                            <ul>

                                                @foreach ($brands as $brand)
                                                    <li><a href="/products/filter?sort=name&filter%5Bbrand%5D={{ $brand->id}}&filter%5Bprice%5D=">{{ $brand->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="single-product-gallery-left.html">Mức giá</a>
                                            <ul>
                                                <li><a href="/products/filter?sort=name&filter%5Bprice%5D=0%3B2000000">Dưới
                                                        2 triệu</a></li>
                                                <li><a
                                                        href="/products/filter?sort=name&filter%5Bprice%5D=2000000%3B4000000">Từ
                                                        2 đến 4 triệu</a>
                                                </li>
                                                <li><a
                                                        href="/products/filter?sort=name&filter%5Bprice%5D=4000000%3B7000000">Từ
                                                        4 đến 7 triệu</a>
                                                </li>
                                                <li><a
                                                        href="/products/filter?sort=name&filter%5Bprice%5D=7000000%3B13000000">Từ
                                                        7 đến 13
                                                        triệu</a></li>
                                                <li><a
                                                        href="/products/filter?sort=name&filter%5Bprice%5D=13000000%3B20000000">Từ
                                                        13 đến 20
                                                        triệu</a></li>
                                                <li><a
                                                        href="/products/filter?sort=name&filter%5Bprice%5D=20000000%3B100000000">Trên
                                                        20 triệu</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="single-product.html">Loại điện thoại</a>
                                            <ul>
                                                <li><a
                                                        href="/products/filter?sort=name&filter%5Bprice%5D=&filter%5Bos%5D=Android">Android</a>
                                                </li>
                                                <li><a
                                                        href="/products/filter?sort=name&filter%5Bprice%5D=&filter%5Bos%5D=IOS">iOS</a>
                                                </li>
                                                <li><a
                                                        href="/products/filter?sort=name&filter%5Bprice%5D=&filter%5Bos%5D=Other">Điện
                                                        thoại phổ thông</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="single-product.html">Danh mục điện thoại</a>
                                            <ul>

                                                        @foreach ($categories as $category)
                                                              <li><a href="/products/filter?sort=name&filter%5Bprice%5D=&filter%5Bcategory%5D={{ $category->id}}">{{ $category->name}}</a>
                                                            </li>
                                                        @endforeach
                                            </ul>
                                        </li>

                                    </ul>
                                </li>
                                @foreach ($categories as $category)
                                   <a class="category-hover" href="/products/filter?sort=name&filter%5Bprice%5D=&filter%5Bcategory%5D={{ $category->id}}" class="menu_no_arrow">{{ $category->name}}</a>
                                @endforeach



                                {{-- <li class="dropdown-holder"><a href="blog-left-sidebar.html">BÀI VIẾT</a>
                                    <ul class="hb-dropdown">
                                        <li class="sub-dropdown-holder"><a href="blog-left-sidebar.html">Mới
                                                nhất</a>
                                            <ul class="hb-dropdown hb-sub-dropdown">
                                                <li><a href="blog-2-column.html">Mới nhất</a></li>
                                                <li><a href="blog-3-column.html">Sản phẩm mới</a></li>
                                                <li><a href="blog-left-sidebar.html">Đánh giá</a></li>
                                                <li><a href="blog-right-sidebar.html">Tư vấn</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-dropdown-holder"><a href="blog-list-left-sidebar.html">Sản
                                                phẩm mới</a>

                                        </li>
                                        <li class="sub-dropdown-holder"><a href="blog-details-left-sidebar.html">Đánh
                                                giá</a>
                                        </li>
                                        <li class="sub-dropdown-holder"><a href="blog-gallery-format.html">Tư vấn</a>
                                        </li>
                                    </ul>
                                </li> --}}
                                {{-- <li><a href="contact.html" class="menu_no_arrow">LIÊN HỆ</a></li> --}}
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
