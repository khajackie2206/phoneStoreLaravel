@extends('index')
@section('content')
    <!-- Header Area End Here -->
    <!-- Begin Slider With Banner Area -->
    <div class="slider-with-banner">
        <div class="container">
            <div class="row">
                <!-- Begin Slider Area -->
                <div class="col-lg-8 col-md-8">
                    <div class="slider-area">
                        <div class="slider-active owl-carousel">
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left  animation-style-01 bg-1">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h5>Giảm sốc <span>-20% Off</span> Tuần này</h5>
                                    <h2>Samsung Galaxy S20 | S20+</h2>
                                    <h3>Chỉ từ <span>19.990.000 Đ</span></h3>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Slide Area End Here -->
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left animation-style-02 bg-2">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h5>Deal Khủng</h5>
                                    <h2>Iphone 13</h2>
                                    <h3>Chỉ từ <span>20.990.000 Đ</span></h3>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Slide Area End Here -->
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left animation-style-01 bg-3">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h5>Deal khủng <span>-10% </span> tuần này</h5>
                                    <h2>Mi 12S Ultra</h2>
                                    <h3>Chỉ từ <span>22.900.000 Đ</span></h3>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Slide Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Slider Area End Here -->
                <!-- Begin Li Banner Area -->
                <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                    <div class="li-banner">
                        <a href="#">
                            <img src="https://www.techyloud.com/wp-content/uploads/2020/07/iPhone-13-1536x864.jpg"
                                alt="">
                        </a>
                    </div>
                    <div class="li-banner mt-30 mt-sm-30 mt-xs-30">
                        <a href="#">
                            <img src="https://www.techyloud.com/wp-content/uploads/2020/07/iPhone-13-1536x864.jpg"
                                alt="">
                        </a>
                    </div>
                </div>
                <!-- Li Banner Area End Here -->
            </div>
        </div>
    </div>
    <!-- Slider With Banner Area End Here -->
    <!-- Begin Product Area -->
    <div class="product-area pt-60 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#li-new-product"><span>Mới ra mắt</span></a>
                            </li>
                            <li><a data-toggle="tab" href="#li-bestseller-product"><span>Bán chạy nhất</span></a></li>
                            <li><a data-toggle="tab" href="#li-featured-product"><span>Tính năng</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($productsNewly as $productNewly)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->

                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="/products/details/{{ $productNewly->id }}">
                                                <img src="{{ $productNewly->images->where('type', 'cover')->first()['url'] }}"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                            </a>
                                            <span class="sticker"
                                                style="background-color: yellow; color: black; font-weight:bold;">New</span>
                                        </div>

                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="shop-left-sidebar.html">{{ $productNewly->brand->name }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="single-product.html">{{ $productNewly->name }}</a></h4>
                                                <div class="price-box">
                                                    <span class="new-price">
                                                        <p style="color: red; font-weight:bold;">
                                                            {{ number_format($productNewly->price) }} đ</p>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="/products/details/{{ $productNewly->id }}">ĐẶT MUA NGAY</a></li>
                                                    <li>
                                                        <p productId="{{ $productNewly->id }}" title="quick view"
                                                            class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><i class="fa fa-eye"></i></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                            <!-- single-product-wrap end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Product Area End Here -->
    <!-- Begin Li's Static Banner Area -->
    <div class="li-static-banner">
        <div class="container">
            <div class="row">
                <!-- Begin Single Banner Area -->
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="single-banner">
                        <a href="#">
                            <img src="https://genk.mediacdn.vn/139269124445442048/2022/6/6/006bwonyly1h2yx7canotj335s1s0gsj-1654533212611-1654533212701993366771.jpg"
                                alt="Li's Static Banner">
                        </a>
                    </div>
                </div>
                <!-- Single Banner Area End Here -->
                <!-- Begin Single Banner Area -->
                <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                    <div class="single-banner">
                        <a href="#">
                            <img src="https://cdn.tgdd.vn/Files/2022/04/21/1427587/applewatchseries8-_1920x1080-800-resize.jpg"
                                alt="Li's Static Banner">
                        </a>
                    </div>
                </div>
                <!-- Single Banner Area End Here -->
                <!-- Begin Single Banner Area -->
                <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                    <div class="single-banner">
                        <a href="#">
                            <img src="https://file.hstatic.net/200000144777/file/apple_iphone13_colors_09142021_big.jpg.large_c3a69d0ee4774b12a58836b1fba2334b.jpg"
                                alt="Li's Static Banner">
                        </a>
                    </div>
                </div>
                <!-- Single Banner Area End Here -->
            </div>
        </div>
    </div>
    <!-- Li's Static Banner Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Deal khủng</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($productsDiscount as $productDiscount)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->

                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="/products/details/{{ $productDiscount->id }}">
                                                <img src="{{ $productDiscount->images->where('type', 'cover')->first()['url'] }}"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                            </a>
                                        </div>

                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="shop-left-sidebar.html">{{ $productDiscount->brand->name }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="single-product.html">{{ $productDiscount->name }}</a></h4>
                                                <div class="price-box">
                                                    <span class="new-price">
                                                        <p style="color: red; font-weight:bold;">
                                                            {{ number_format($productDiscount->price) }} đ</p>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="#">ĐẶT MUA NGAY</a></li>
                                                    <li>
                                                        <p productId="{{ $productDiscount->id }}" title="quick view"
                                                            class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><i class="fa fa-eye"></i>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Laptop Product Area End Here -->

    <!-- Begin Li's Static Home Area -->
    <div class="li-static-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Li's Static Home Image Area -->
                    <div class="li-static-home-image"></div>
                    <!-- Li's Static Home Image Area End Here -->
                    <!-- Begin Li's Static Home Content Area -->
                    <div class="li-static-home-content">
                        <p>Giảm sốc<span> -20% </span>Tuần này</p>
                        <h2>Sản phẩm</h2>
                        <h2>Hệ sinh thái Apple</h2>
                        <p class="schedule">
                            Chỉ từ
                            <span> 6.990.000 Đ</span>
                        </p>
                        <div class="default-btn">
                            <a href="shop-left-sidebar.html" class="links">MUA NGAY</a>
                        </div>
                    </div>
                    <!-- Li's Static Home Content Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Li's Static Home Area End Here -->
    <!-- Begin Li's Trending Product Area -->
    <!-- Begin Li's Trendding Products Area -->
    <section class="product-area li-laptop-product li-trendding-products best-sellers pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12" style="padding-top: 20px;">
                    <div class="li-section-title">
                        <h2>
                            <span>Sản phẩm nổi bật</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($goodProducts as $goodProduct)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="/products/details/{{ $goodProduct->id }}">
                                                <img src="{{ $goodProduct->images->where('type', 'cover')->first()['url'] }}"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                            </a>
                                        </div>

                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="shop-left-sidebar.html">{{ $goodProduct->brand->name }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="single-product.html">{{ $goodProduct->name }}</a></h4>
                                                <div class="price-box">
                                                    <span class="new-price">
                                                        <p style="color: red; font-weight:bold;">
                                                            {{ number_format($goodProduct->price) }} đ</p>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="/products/details/{{ $goodProduct->id }}">ĐẶT MUA NGAY</a></li>
                                                    <li>
                                                        <p productId="{{ $goodProduct->id }}" title="quick view"
                                                            class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><i class="fa fa-eye"></i>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Trendding Products Area End Here -->
@endsection
