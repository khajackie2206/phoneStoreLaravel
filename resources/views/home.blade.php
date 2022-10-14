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
                            @foreach ($bannerHeaders as $header)
                                  <div class="single-slide align-center-left  animation-style-01 bg-1" style="background-image: url({{$header->thumb}});">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h5>{{ $header->header }}</h5>
                                    <h2>{{ $header->product_name}}</h2>
                                    <h3>Chỉ từ: <span>{{ number_format((float)$header->price,0,',', '.') }} Đ</span></h3>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="{{ $header->url}}">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Slider Area End Here -->
                <!-- Begin Li Banner Area -->
                <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                    @foreach ($staticHeaders as $banner)
                    <div class="li-banner mb-30 mt-sm-30 mt-xs-30">
                        <a href="{{$banner->url}}">
                            <img src="{{$banner->thumb}}"
                                alt="">
                        </a>
                    </div>
                       @endforeach
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
                                                     @if ($productNewly->discount > 0)
                                                             <p style="color: red; font-weight:bold;">
                                                            {{ number_format($productNewly->price-$productNewly->discount) }} <span style="text-decoration: underline;">đ</span></p>
                                                     @else
                                                           <p style="color: red; font-weight:bold;">
                                                            {{ number_format($productNewly->price) }} <span style="text-decoration: underline;">đ</span></p>
                                                     @endif
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
                @foreach ($centerBanners as $banner)
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="single-banner" >
                        <a href="{{$banner->url}}">
                            <img src="{{$banner->thumb}}"
                                alt="Li's Static Banner">
                        </a>
                    </div>
                </div>
                @endforeach
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
                                                          @if ($productDiscount->discount > 0)
                                                             <p style="color: red; font-weight:bold;">
                                                            {{ number_format($productDiscount->price-$productDiscount->discount) }} <span style="text-decoration: underline;">đ</span></p>
                                                     @else
                                                           <p style="color: red; font-weight:bold;">
                                                            {{ number_format($productDiscount->price) }} <span style="text-decoration: underline;">đ</span></p>
                                                     @endif
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
                        <p>{{ $broadcastBanner->header}}</p>
                        <h2>Sản phẩm</h2>
                        <h2>{{ $broadcastBanner->product_name }}</h2>
                        <p class="schedule">
                            Chỉ từ:
                            <span> {{ number_format((float)$broadcastBanner->price,0,',', '.') }} Đ</span>
                        </p>
                        <div class="default-btn">
                            <a href="{{$broadcastBanner->url}}" class="links">MUA NGAY</a>
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
                                                              @if ($goodProduct->discount > 0)
                                                             <p style="color: red; font-weight:bold;">
                                                            {{ number_format($goodProduct->price-$goodProduct->discount) }} <span style="text-decoration: underline;">đ</span></p>
                                                     @else
                                                           <p style="color: red; font-weight:bold;">
                                                            {{ number_format($goodProduct->price) }} <span style="text-decoration: underline;">đ</span></p>
                                                     @endif
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
