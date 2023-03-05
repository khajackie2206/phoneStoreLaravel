@extends('index')
@section('content')
{{-- <div class="loader-wrapper" style="z-index: 2000;">
    <span class="loader"><span class="loader-inner"></span></span>
</div> --}}
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
                        <div class="single-slide align-center-left  animation-style-01 bg-1"
                            style="background-image: url({{ $header->thumb }});">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>{{ $header->header }}</h5>
                                <h2>{{ $header->product_name }}</h2>
                                <h3>Chỉ từ: <span>{{ number_format((float) $header->price, 0, ',', '.') }}
                                        Đ</span>
                                </h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="{{ $header->url }}">Mua ngay</a>
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
                    <a href="{{ $banner->url }}">
                        <img src="{{ $banner->thumb }}" alt="">
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
<div class="product-area pt-60 pb-45">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#li-new-product"><span>Mới ra mắt</span></a>
                        </li>
                        <li><a data-toggle="tab" href="#li-bestseller-product"><span>Bán chạy nhất</span></a></li>
                        <li><a data-toggle="tab" href="#li-featured-product"><span>Được yêu thích</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($productsNewly as $productNewly)
                            <?php
                                $countRatingNewly = count($productNewly->comments->where('status', 1));
                                $avgRatingNewly = 0;
                                $sumRatingNewly = 0;
                                if ($countRatingNewly > 0) {
                                    foreach ($productNewly->comments->where('status', 1) as $comment) {
                                        $sumRatingNewly += $comment->rating;
                                    }
                                    $avgRatingNewly = $sumRatingNewly / $countRatingNewly;
                                }

                                ?>
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="/products/details/{{ $productNewly->id }}">
                                            @if(isset($productNewly->images->where('type', 'cover')->first()['url']))
                                            <img src="{{ $productNewly->images->where('type', 'cover')->first()['url'] }}"
                                                alt="Li's Product Image" style="width: 120px;height:120px;">
                                            @endif
                                        </a>
                                        <span class="sticker"
                                            style="background-color: yellow; color: black; font-weight:bold;">New</span>
                                    </div>

                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a href="shop-left-sidebar.html">{{ $productNewly->brand->name
                                                        }}</a>
                                                </h5>
                                                <div class="rating-box">
                                                    <ul class="rating">
                                                        <li class="{{ $avgRatingNewly >= 1 ? '' : 'no-star' }}"><i
                                                                class="fa fa-star-o"></i></li>
                                                        <li class="{{ $avgRatingNewly >= 2 ? '' : 'no-star' }}"><i
                                                                class="fa fa-star-o"></i></li>
                                                        <li class="{{ $avgRatingNewly >= 3 ? '' : 'no-star' }}"><i
                                                                class="fa fa-star-o"></i></li>
                                                        <li class="{{ $avgRatingNewly >= 4 ? '' : 'no-star' }}"><i
                                                                class="fa fa-star-o"></i></li>
                                                        <li class="{{ $avgRatingNewly >= 5 ? '' : 'no-star' }}"><i
                                                                class="fa fa-star-o"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <h4><a class="product_name" href="single-product.html">{{
                                                    $productNewly->name }}</a></h4>
                                            <div class="price-box">
                                                @if ($productNewly->discount > 0)
                                                <span style="color: red; font-weight:bold;">
                                                    {{ number_format($productNewly->price - $productNewly->discount) }}
                                                    <span style="text-decoration: underline;">đ</span>
                                                </span>

                                                <span
                                                    style="color: #333; font-weight:bold; font-size: 85%;margin-left: 5px;text-decoration: line-through;">
                                                    {{ number_format($productNewly->price) }} <span
                                                        style="text-decoration: underline;">đ</span></span>
                                                <span></span>
                                                <span class="discount-percentage">-{{
                                                    number_format(($productNewly->discount/$productNewly->price)*100)
                                                    }}%</span>

                                                @else
                                                <p style="color: red; font-weight:bold;">
                                                    {{ number_format($productNewly->price) }} <span
                                                        style="text-decoration: underline;">đ</span></p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a
                                                        href="/products/details/{{ $productNewly->id }}">ĐẶT MUA
                                                        NGAY</a></li>
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
            <div id="li-bestseller-product" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($bestSellers as $bestSeller)
                            <?php
                                $countRatingSeller = count($bestSeller->comments->where('status', 1));
                                $avgRatingSeller = 0;
                                $sumRatingSeller = 0;
                                if ($countRatingSeller > 0) {
                                foreach ($bestSeller->comments->where('status', 1) as $comment) {
                                 $sumRatingSeller += $comment->rating;
                                    }
                                $avgRatingSeller = $sumRatingSeller / $countRatingSeller;
                                }

                                ?>
                           <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="/products/details/{{ $bestSeller->id }}">
                                                @if(isset($bestSeller->images->where('type', 'cover')->first()['url']))
                                                <img src="{{ $bestSeller->images->where('type', 'cover')->first()['url'] }}" alt="Li's Product Image"
                                                    style="width: 120px;height:120px;">
                                                @endif
                                            </a>
                                            <span class="sticker" style="background-color: yellow; color: black; font-weight:bold;">Top</span>
                                        </div>

                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="shop-left-sidebar.html">{{ $bestSeller->brand->name
                                                            }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li class="{{ $avgRatingSeller >= 1 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                                            <li class="{{ $avgRatingSeller >= 2 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                                            <li class="{{ $avgRatingSeller>= 3 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                                            <li class="{{ $avgRatingSeller>= 4 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                                            <li class="{{ $avgRatingSeller >= 5 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name" href="single-product.html">{{
                                                        $bestSeller->name }}</a></h4>
                                                <div class="price-box">
                                                    @if ($bestSeller->discount > 0)
                                                    <span style="color: red; font-weight:bold;">
                                                        {{ number_format($bestSeller->price - $bestSeller->discount) }}
                                                        <span style="text-decoration: underline;">đ</span>
                                                    </span>

                                                    <span
                                                        style="color: #333; font-weight:bold; font-size: 85%;margin-left: 5px;text-decoration: line-through;">
                                                        {{ number_format($bestSeller->price) }} <span
                                                            style="text-decoration: underline;">đ</span></span>
                                                    <span></span>
                                                    <span class="discount-percentage">-{{
                                                        number_format(($bestSeller->discount/$bestSeller->price)*100)
                                                        }}%</span>

                                                    @else
                                                    <p style="color: red; font-weight:bold;">
                                                        {{ number_format($bestSeller->price) }} <span style="text-decoration: underline;">đ</span></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="/products/details/{{ $bestSeller->id }}">ĐẶT MUA
                                                            NGAY</a></li>
                                                    <li>
                                                        <p productId="{{ $bestSeller->id }}" title="quick view" class="quick-view-btn"
                                                            data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div id="li-featured-product" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="product-active owl-carousel">
                                @foreach ($topRatings as $topRating)
                                <?php
                                            $countRatingTop = count($topRating->comments->where('status', 1));
                                            $avgRatingTop = 0;
                                            $sumRatingTop = 0;
                                            if ($countRatingTop > 0) {
                                            foreach ($topRating->comments->where('status', 1) as $comment) {
                                             $sumRatingTop += $comment->rating;
                                                }
                                            $avgRatingTop = $sumRatingTop / $countRatingTop;
                                            }

                                            ?>
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="/products/details/{{ $topRating->id }}">
                                                @if(isset($topRating->images->where('type', 'cover')->first()['url']))
                                                <img src="{{ $topRating->images->where('type', 'cover')->first()['url'] }}"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                @endif
                                            </a>
                                            <span class="sticker"
                                                style="background-color: yellow; color: black; font-weight:bold;">Like</span>
                                        </div>

                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="shop-left-sidebar.html">{{ $topRating->brand->name
                                                            }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li class="{{ $avgRatingTop >= 1 ? '' : 'no-star' }}"><i
                                                                    class="fa fa-star-o"></i></li>
                                                            <li class="{{ $avgRatingTop >= 2 ? '' : 'no-star' }}"><i
                                                                    class="fa fa-star-o"></i></li>
                                                            <li class="{{ $avgRatingTop >= 3 ? '' : 'no-star' }}"><i
                                                                    class="fa fa-star-o"></i></li>
                                                            <li class="{{ $avgRatingTop >= 4 ? '' : 'no-star' }}"><i
                                                                    class="fa fa-star-o"></i></li>
                                                            <li class="{{ $avgRatingTop >= 5 ? '' : 'no-star' }}"><i
                                                                    class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name" href="single-product.html">{{
                                                        $topRating->name }}</a></h4>
                                                <div class="price-box">
                                                    @if ($topRating->discount > 0)
                                                    <span style="color: red; font-weight:bold;">
                                                        {{ number_format($topRating->price - $topRating->discount) }}
                                                        <span style="text-decoration: underline;">đ</span>
                                                    </span>

                                                    <span
                                                        style="color: #333; font-weight:bold; font-size: 85%;margin-left: 5px;text-decoration: line-through;">
                                                        {{ number_format($topRating->price) }} <span
                                                            style="text-decoration: underline;">đ</span></span>
                                                    <span></span>
                                                    <span class="discount-percentage">-{{
                                                        number_format(($topRating->discount/$topRating->price)*100)
                                                        }}%</span>

                                                    @else
                                                    <p style="color: red; font-weight:bold;">
                                                        {{ number_format($topRating->price) }} <span
                                                            style="text-decoration: underline;">đ</span></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a
                                                            href="/products/details/{{ $topRating->id }}">ĐẶT MUA
                                                            NGAY</a></li>
                                                    <li>
                                                        <p productId="{{ $topRating->id }}" title="quick view"
                                                            class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><i class="fa fa-eye"></i></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
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
                <div class="single-banner">
                    <a href="{{ $banner->url }}">
                        <img src="{{ $banner->thumb }}" alt="Li's Static Banner">
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
                        <?php
                                $countRatingDiscount = count($productDiscount->comments->where('status', 1));
                                $avgRatingDiscount = 0;
                                $sumRatingDiscount = 0;
                                if ($countRatingDiscount > 0) {
                                    foreach ($productDiscount->comments->where('status', 1) as $comment) {
                                        $sumRatingDiscount += $comment->rating;
                                    }
                                    $avgRatingDiscount = $sumRatingDiscount / $countRatingDiscount;
                                }

                                ?>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->

                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="/products/details/{{ $productDiscount->id }}">
                                        @if(isset($productDiscount->images->where('type', 'cover')->first()['url']))
                                        <img src="{{ $productDiscount->images->where('type', 'cover')->first()['url'] }}"
                                            alt="Li's Product Image" style="width: 120px;height:120px;">
                                        @endif
                                    </a>
                                </div>

                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="shop-left-sidebar.html">{{ $productDiscount->brand->name }}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    <li class="{{ $avgRatingDiscount >= 1 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="{{ $avgRatingDiscount >= 2 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="{{ $avgRatingDiscount >= 3 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="{{ $avgRatingDiscount >= 4 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="{{ $avgRatingDiscount >= 5 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="single-product.html">{{ $productDiscount->name
                                                }}</a></h4>
                                        <div class="price-box">
                                            <span class="new-price">
                                                @if ($productDiscount->discount > 0)
                                                <span style="color: red; font-weight:bold;">
                                                    {{ number_format($productDiscount->price -
                                                    $productDiscount->discount) }}
                                                    <span style="text-decoration: underline;">đ</span>
                                                </span>
                                                <span
                                                    style="color: #333; font-weight:bold; font-size: 85%;margin-left: 5px;text-decoration: line-through;">
                                                    {{ number_format($productDiscount->price) }} <span
                                                        style="text-decoration: underline;">đ</span></span>
                                                <span class="discount-percentage">-{{
                                                    number_format(($productDiscount->discount/$productDiscount->price)*100)
                                                    }}%</span>
                                                @else
                                                <p style="color: red; font-weight:bold;">
                                                    {{ number_format($productDiscount->price) }} <span
                                                        style="text-decoration: underline;">đ</span></p>
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
                    @if(isset($broadcastBanner))
                    <p>{{ $broadcastBanner->header }}</p>
                    <h2>Sản phẩm</h2>
                    <h2>{{ $broadcastBanner->product_name }}</h2>
                    <p class="schedule">
                        Chỉ từ:
                        <span> {{ number_format((float) $broadcastBanner->price, 0, ',', '.') }} Đ</span>
                    </p>
                    <div class="default-btn">
                        <a href="{{ $broadcastBanner->url }}" class="links">MUA NGAY</a>
                    </div>
                    @endif
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
                        <?php
                                $countRatingGood = count($goodProduct->comments->where('status', 1));
                                $avgRatingGood = 0;
                                $sumRatingGood = 0;
                                if ($countRatingGood > 0) {
                                    foreach ($goodProduct->comments->where('status', 1) as $comment) {
                                        $sumRatingGood += $comment->rating;
                                    }
                                    $avgRatingGood = $sumRatingGood / $countRatingGood;
                                }

                                ?>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="/products/details/{{ $goodProduct->id }}">
                                        @if(isset($goodProduct->images->where('type', 'cover')->first()['url']))
                                        <img src="{{ $goodProduct->images->where('type', 'cover')->first()['url'] }}"
                                            alt="Li's Product Image" style="width: 120px;height:120px;">
                                        @endif
                                    </a>
                                </div>

                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="shop-left-sidebar.html">{{ $goodProduct->brand->name }}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    <li class="{{ $avgRatingGood >= 1 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="{{ $avgRatingGood >= 2 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="{{ $avgRatingGood >= 3 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="{{ $avgRatingGood >= 4 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="{{ $avgRatingGood >= 5 ? '' : 'no-star' }}"><i
                                                            class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="single-product.html">{{ $goodProduct->name
                                                }}</a></h4>
                                        <div class="price-box">
                                            <span class="new-price">
                                                @if ($goodProduct->discount > 0)
                                                <span style="color: red; font-weight:bold;">
                                                    {{ number_format($goodProduct->price - $goodProduct->discount) }}
                                                    <span style="text-decoration: underline;">đ</span>
                                                </span>
                                                <span
                                                    style="color: #333; font-weight:bold; font-size: 85%;margin-left: 5px;text-decoration: line-through;">
                                                    {{ number_format($goodProduct->price) }} <span
                                                        style="text-decoration: underline;">đ</span></span>
                                                <span class="discount-percentage">-{{
                                                    number_format(($goodProduct->discount/$goodProduct->price)*100)
                                                    }}%</span>
                                                @else
                                                <p style="color: red; font-weight:bold;">
                                                    {{ number_format($goodProduct->price) }} <span
                                                        style="text-decoration: underline;">đ</span></p>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a
                                                    href="/products/details/{{ $goodProduct->id }}">ĐẶT MUA
                                                    NGAY</a></li>
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
