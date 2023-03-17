@extends('index')
@section('content')
<div class="loader-wrapper" style="z-index: 2000;">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<!-- Li's Breadcrumb Area End Here -->
<div class="breadcrumb-area" style="margin-top: -20px;">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li class="active">Điện thoại {{ $product->name }}</li>
            </ul>
        </div>
    </div>
</div>
<?php

    if ($product->discount > 0) {
        $priceSale = $product->price - $product->discount;
    }

    $countRating = count($comments);
    $avgRating = 0;
    $sumRating = 0;
    if ($countRating > 0) {
        foreach ($comments as $comment) {
            $sumRating += $comment->rating;
        }
        $avgRating = $sumRating / count($comments);
    }

    ?>
<!-- content-wraper start -->
<div class="content-wraper" style="margin-bottom: -300px; margin-top:30px;">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left" style="margin-top: 25px;">
                    <div class="product-details-images slider-navigation-1">
                        @foreach ($product->images as $image)
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="{{ $image->url }}" data-gall="myGallery">
                                <img src="{{ $image->url }}" alt="product image" style="max-height: 510px;">
                            </a>
                        </div>
                        @endforeach

                    </div>
                    <div class="product-details-thumbs slider-thumbs-1" style="margin-top: 20px;">

                        @foreach ($product->images as $image)
                        <div class="sm-image"><img src="{{ $image->url }}" alt="product image thumb"
                                style="max-height: 160px; "></div>
                        @endforeach
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h2>{{ $product->name }} <span style="margin-left: 70px;">
                                @foreach ($groupProduct as $item)
                                @if ($item->rom == $product->rom)
                                <a href="/products/details/{{ $item->id }}"
                                    style="border: solid #0363cd 1px;font-size: 15px; padding: 10px; border-radius: 2px; ">{{
                                    $item->ram }}
                                    GB - {{ $item->rom }}</a>
                                @else
                                <a href="/products/details/{{ $item->id }}"
                                    style="border: 1px solid #e0e0e0;font-size: 15px; padding: 10px; color: #333; border-radius: 2px; ">{{
                                    $item->ram }}
                                    GB - {{ $item->rom }}</a>
                                @endif
                                @endforeach

                            </span></h2>
                        <span class="product-details-ref">Thương hiệu: {{ $product->brand->name }}</span>
                        <div class="rating-box pt-20">
                            <ul class="rating rating-with-review-item">
                                <li class="{{ $avgRating >= 1 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                <li class="{{ $avgRating >= 2 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                <li class="{{ $avgRating >= 3 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                <li class="{{ $avgRating >= 4 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                <li class="{{ $avgRating >= 5 ? '' : 'no-star' }}"><i class="fa fa-star-o"></i></li>
                                <li><a href="#" style="color: #2f80ed;font-size: 9pt;"> &nbsp; ({{ $countRating }})
                                        Đánh
                                        giá</a></li>
                            </ul>
                        </div>
                        @if ($product->active === 0)
                        <div class="price-box pt-20">
                            <strong
                                style="display: block; line-height: 1.3em;font-size: 16px;color: red;text-transform: uppercase;margin-bottom: 10px;">
                                Sản phẩm đã ngừng kinh doanh</strong>
                        </div>
                        @elseif ($product->quantity === 0)

                        <div class="price-box pt-20">
                            <strong
                                style="display: block; line-height: 1.3em;font-size: 16px;color: red;text-transform: uppercase;margin-bottom: 10px;">
                                Sản phẩm đã hết hàng</strong>
                        </div>
                        @else
                        <div class="price-box pt-20">
                            @if (isset($priceSale))
                            <span class="new-price new-price-2">
                                {{ number_format($priceSale) }}
                                <span style="text-decoration: underline;">
                                    đ
                                </span>
                            </span>

                            <span class="new-price new-price-2"
                                style="color: #666; font-size: 20px; margin-left: 30px; text-decoration-line: line-through;">
                                {{ number_format($product->price) }}
                                <span style="text-decoration: underline;">
                                    đ
                                </span>
                            </span>

                            <span class="discountPercentage"
                                style="margin-left: 10px;color: #e80f0f;font-weight: bold; font-size: 120%;">-{{
                                number_format(($product->discount/$product->price)*100) }}%</span>
                            @else
                            <span class="new-price new-price-2">
                                {{ number_format($product->price) }}
                                <span style="text-decoration: underline;">
                                    đ
                                </span>
                            </span>
                            @endif
                        </div>
                        @endif
                        <div class="product-desc">
                            <p>
                                <span>
                                    {{ $product->short_description }}
                                </span>
                            </p>
                        </div>
                        <form action="/products/cart" method="POST" class="cart-quantity" style="margin-top:10px;">
                            <div class="product-variants">
                                <div class="produt-variants-size">
                                    <label style="margin-bottom: 20px; font-weight: 600;font-size:15px;">Màu
                                        sắc</label>
                                    <a href="#"
                                        style="border: solid #0363cd 1px;color:#0363cd ;font-size: 15px; padding: 10px; border-radius: 2px;font-weight:500;font-size:15px; ">
                                        {{ $product->color }}</a>
                                </div>
                            </div>
                            <div class="single-add-to-cart" style="margin-top: 25px;">

                                <div class="quantity">
                                    <label>Số lượng</label>
                                    <div class="cart-plus-minus card-plus-minus-plus">
                                        <input class="cart-plus-minus-box" value="1" type="text" id="product-quantity"
                                            name="quantity">
                                        <div class="dec qtybutton" action="quantity-dec"><i
                                                class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton qtybutton1" action="quantity-inc"><i
                                                class="fa fa-angle-up"></i>
                                        </div>
                                    </div>
                                </div>
                                <button class="add-to-cart" type="submit">Đặt mua ngay</button>
                            </div>
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <input type="hidden" id="url" name="url" value="/products/details/{{ $product->id }}">
                            @csrf
                        </form>

                        <div class="product-additional-info pt-20">
                            <a class="wishlist-btn" style="color: grey;" href="wishlist.html"><i
                                    class="fa fa-heart-o"></i>Yêu thích</a>
                            <div class="product-social-sharing pt-25">
                                <ul>
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a>
                                    </li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a>
                                    </li>
                                    <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google
                                            +</a></li>
                                    <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-additional-info pt-20">
                            <a class="wishlist-btn" style="color: grey;" href="wishlist.html">Số lượng hàng: <span
                                    style="font-weight: bold;">{{ $product->quantity }}</span> sản phẩm trong kho</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35" style="margin-top: 330px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#description"><span>Mô tả sản
                                    phẩm</span></a></li>

                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>

        <div class="tab-content" style="margin-top: 20px; margin-bottom: 30px;">
            <div class="container">
                <div class="row" style="margin-left: 0px;">
                    <div class="col-lg-6-half col-md-6-half" style="background-color: #fff;background-clip: border-box;-webkit-box-shadow: 0 0 3px 0 #dee2e6;
                       box-shadow: 0 0 3px 0 #dee2e6;border-radius: 6px; padding: 40px; margin-right: 30px;">
                        <span class="product-desc" style="color: black !important;font-family: inherit !important">
                            {!! $product->description !!}
                        </span>
                    </div>
                    <div class="col-lg-5 col-md-5"
                        style="background-color: #fff;background-clip: border-box;-webkit-box-shadow: 0 0 3px 0 #dee2e6;box-shadow: 0 0 3px 0 #dee2e6;border-radius: 6px; padding:30px;">
                        <table class="table table-striped">
                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h6>Màn hình</h6>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Công nghệ màn hình: </td>
                                <td>{{ $product->display_tech }}, {{ $product->size }},
                                    {{ $product->resolution }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Tần số quét: </td>
                                <td>{{ $product->screen_rate }}</td>
                            </tr>
                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h6>Camera</h6>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Camera sau: </td>
                                <td>{{ $product->rear_cam }}</td>
                            <tr>
                                <td style="font-weight: bold;">Camera trước: </td>
                                <td>{{ $product->font_cam }}</td>
                            </tr>
                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h6>Hệ điều hành & CPU</h6>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Hệ điều hành: </td>
                                <td>{{ $product->os }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Chip xử lý: </td>
                                <td>{{ $product->cpu }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Dung lượng pin: </td>
                                <td>{{ $product->battery }} mAh</td>
                            <tr>
                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h6>Bộ nhớ & Lưu trữ</h6>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">RAM: </td>
                                <td>{{ $product->ram }} GB</td>
                            <tr>
                                <td style="font-weight: bold;">Bộ nhớ trong: </td>
                                <td>{{ $product->rom }}</td>
                            </tr>

                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h6>Thông tin chung</h6>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Tính năng: </td>
                                <td>
                                    <ul>
                                        @foreach ($product->features as $feature)
                                        <li style="list-style-type: circle;">{{ $feature->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            <tr>
                                <td style="font-weight: bold;">Thời gian ra mắt: </td>
                                <td style="color: rgb(66, 90, 224);">{{ $product->year }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


            <div id="reviews" class="tab-pane" role="tabpanel">
                <div class="product-reviews">
                    <div class="product-details-comment-block">

                    </div>
                    <div class="comment-author-infos pt-25">
                        <span>Nguyễn Minh Kha <span>
                                <ul class="rating">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                </ul>
                            </span></span>
                        <em>01-12-22</em>
                    </div>
                    <div class="comment-details" style="margin-top: 1px;">
                        <p>Sản phẩm chất lượng tốt, phù hợp giá tiền</p>
                    </div>
                    <div class="review-btn">
                        <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Viết
                            đánh giá</a>
                    </div>

                </div>
            </div>
        </div>
        </div>
        <div class="container rating-area" style="margin-top: 5px;" id="foo">
            <div class="row">
                <div class="col-lg-4">
                    <div class="d-flex justify-content-center">
                        <div class="content text-center">
                            <div class="ratings">
                                <span class="product-rating">{{ $avgRating }}</span><span>/5</span>
                                <div class="stars">
                                    <i class="{{ $avgRating >= 1 ? 'fa fa-star' : '' }}"></i>
                                    <i class="{{ $avgRating >= 2 ? 'fa fa-star' : '' }}"></i>
                                    <i class="{{ $avgRating >= 3 ? 'fa fa-star' : '' }}"></i>
                                    <i class="{{ $avgRating >= 4 ? 'fa fa-star' : '' }}"></i>
                                    <i class="{{ $avgRating >= 5 ? 'fa fa-star' : '' }}"></i>
                                </div>
                                <div class="rating-text">
                                    <span>{{ $countRating }} đánh giá</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="margin-top: 40px;">

                    <div class="rating-bar0 justify-content-center">
                        <table class="text-left mx-auto">
                            <tr>
                                <td class="rating-label">5 <i class="fa fa-star" style="color: #fbc634;"></i> </td>
                                <td class="rating-bar">
                                    <div class="bar-container">
                                        <div class="bar-5"
                                            style="width: {{ ($countRating > 0) ? (count($comments->where('rating', 5))/$countRating)*100 : 0 }}%">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">{{ count($comments->where('rating', 5)) }}</td>
                            </tr>
                            <tr>
                                <td class="rating-label">4 <i class="fa fa-star" style="color: #fbc634;"></i></td>
                                <td class="rating-bar">
                                    <div class="bar-container">
                                        <div class="bar-4"
                                            style="width: {{ ($countRating > 0) ? (count($comments->where('rating', 4))/$countRating)*100 : 0 }}%">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">{{ count($comments->where('rating', 4)) }}</td>
                            </tr>
                            <tr>
                                <td class="rating-label">3 <i class="fa fa-star" style="color: #fbc634;"></i></td>
                                <td class="rating-bar">
                                    <div class="bar-container">
                                        <div class="bar-3"
                                            style="width: {{ ($countRating > 0) ? (count($comments->where('rating', 3))/$countRating)*100 : 0 }}%">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">{{ count($comments->where('rating', 3)) }}</td>
                            </tr>
                            <tr>
                                <td class="rating-label">2 <i class="fa fa-star" style="color: #fbc634;"></i></td>
                                <td class="rating-bar">
                                    <div class="bar-container">
                                        <div class="bar-2"
                                            style="width: {{ ($countRating > 0) ? (count($comments->where('rating', 2))/$countRating)*100 : 0 }}%">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">{{ count($comments->where('rating', 2)) }}</td>
                            </tr>
                            <tr>
                                <td class="rating-label">1 <i class="fa fa-star" style="color: #fbc634;"></i></td>
                                <td class="rating-bar">
                                    <div class="bar-container">
                                        <div class="bar-1"
                                            style="width: {{ ($countRating > 0) ? (count($comments->where('rating', 1))/$countRating)*100 : 0 }}%">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">{{ count($comments->where('rating', 1)) }}</td>
                            </tr>
                        </table>
                        {{--
                    </div> --}}
                </div>

            </div>

            <div class="col-lg-4" style="text-align: center; margin-top: 100px;">
                <div class="review-btn">
                    <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Viết
                        đánh giá</a>
                </div>
            </div>

        </div>
        <!--Begin comment -->
        <div class="container" style="padding: 10px 50px 50px 50px;">
            <div style="border-top:1px solid#f1f1f1"> </div>
            <div class="row" style="margin-top:50px; ">

                @foreach ($comments as $comment)
                <div class="col-md-12">
                    <div class="media g-mb-30 media-comment" style="margin-bottom: 30px;">
                        <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"
                            style="width: 50px; margin-right: 15px;" src="{{ $comment->user->avatar }}"
                            alt="Image Description">
                        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                            <div class="g-mb-15">
                                <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->user->name }}
                                    @if($comment->user->orders != "[]")
                                    <span style="color: #2f855a;font-size: 14px;"><img
                                            src="https://cms-assets.tutsplus.com/cdn-cgi/image/width=850/uploads/users/523/posts/32694/final_image/tutorial-preview-large.png"
                                            width="25px">Đã mua tại cửa hàng</span>
                                    @endif
                                    {{-- <span> {{ $comment->user->orders}}</span> --}}
                                </h5>
                                <span class="g-color-gray-dark-v4 g-font-size-12">
                                    <div class="small-ratings">
                                        <i class="fa fa-star {{ $comment->rating >= 1 ? 'rating-color' : '' }}"></i>
                                        <i class="fa fa-star {{ $comment->rating >= 2 ? 'rating-color' : '' }}"></i>
                                        <i class="fa fa-star {{ $comment->rating >= 3 ? 'rating-color' : '' }}"></i>
                                        <i class="fa fa-star {{ $comment->rating >= 4 ? 'rating-color' : '' }}"></i>
                                        <i class="fa fa-star {{ $comment->rating >= 5 ? 'rating-color' : '' }}"></i>
                                    </div>
                                </span>
                            </div>

                            <p>{{ $comment->comment }}
                            </p>

                            <ul class="list-inline d-sm-flex my-0">
                                <li class="list-inline-item g-mr-20">
                                    <span class="g-color-gray-dark-v4 g-font-size-12">{{
                                        $comment->created_at->diffForHumans() }}</span>
                                </li>
                                <li class="list-inline-item g-mr-20">
                                    <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                    </a>
                                </li>
                                <li class="list-inline-item g-mr-20">
                                    <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row justify-content-center" style="margin-top: 30px;">
                {{ $comments->fragment('reviews')->links('custom') }}
            </div>
        </div>
        <!--end comment -->

        <!-- Begin Quick View | Modal Area -->
        <div class="modal fade modal-wrapper" id="mymodal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-inner-area row">
                            <div class="col-lg-6">
                                <!-- Product Details Left -->
                                <div class="product-details-left">
                                    <div class="product-details-images slider-navigation-1">
                                        <div class="lg-image">
                                            <img src="{{ $product->images->where('type', 'cover')->first()['url'] }}"
                                                alt="product image">
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: center;">
                                    <label
                                        style="margin-top: 30px; color: black; font-size: 13px; text-align:center;"><span
                                            style="color: blue;"> * </span>Đánh giá sẽ được phê
                                        duyệt trước khi hiển thị công khai</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="li-review-content">
                                    <!-- Begin Feedback Area -->
                                    <div class="feedback-area">
                                        <div class="feedback">
                                            <h3 class="feedback-title">Đánh giá</h3>
                                            <form action="/products/comment" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <p class="your-opinion">
                                                    <label>Mức độ hài lòng</label>
                                                    <span>
                                                        <select class="star-rating" name="star-rating">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5" selected>5</option>
                                                        </select>
                                                    </span>
                                                </p>
                                                <p class="feedback-form">
                                                    <label for="feedback">Đánh giá của bạn</label>
                                                    <textarea id="feedback" name="comment" cols="45" rows="8"
                                                        aria-required="true"></textarea>
                                                </p>
                                                <div class="feedback-input">
                                                    <p class="feedback-form-author">
                                                        <label for="author">Họ và tên<span class="required">*</span>
                                                        </label>
                                                        @if ($user)
                                                        <input id="author" name="author" value="{{ $user->name }}"
                                                            size="30" aria-required="true" type="text"
                                                            style="background-color: #f1f1f1;" type="text" disabled>
                                                        @else
                                                        <input id="author" name="author" class="required" size="30"
                                                            aria-required="true" type="text">
                                                        @endif
                                                    </p>
                                                    <p class="feedback-form-author feedback-form-email">
                                                        <label for="phone">Số điện thoại<span
                                                                class="required">*</span>
                                                        </label>
                                                        @if ($user)
                                                        <input id="phone" name="phone" value="{{ $user->phone }}"
                                                            size="30" aria-required="true"
                                                            style="background-color: #f1f1f1;" type="text" disabled>
                                                        @else
                                                        <input id="phone" name="phone" class="required" size="30"
                                                            aria-required="true" type="text">
                                                        @endif
                                                        <span class="required"><sub>*</sub> Bắt
                                                            buộc</span>
                                                    </p>
                                                    <div class="feedback-btn pb-15">
                                                        <a href="#" class="close" data-dismiss="modal"
                                                            aria-label="Close">Đóng</a>
                                                        <button type="submit"
                                                            style="background: #242424;color: #fff !important;width: 80px;font-size: 14px; height: 30px;
                                                                 line-height: 30px;text-align: center;left: 110px;right: auto; top: 0;display: block;transition: all 0.3s ease-in-out;cursor: pointer;">Gởi</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Feedback Area End Here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick View | Modal Area End Here -->
    </div>
</div>
</div>

<!-- Product Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<div class="product-area li-laptop-product pt-50 pb-50">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>{{ count($productBrands) }} sản phẩm khác liên quan: </span>
                    </h2>
                </div>
                <div class="row">
                    @foreach ($productBrands as $productBrand)
                    <div class="col-lg-2" style="margin-top: 20px; margin-right: 40px;">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="/products/details/{{ $productBrand->id }}">
                                    <img src="{{ $productBrand->images->where('type', 'cover')->first()['url'] }}"
                                        alt="Li's Product Image" style="width: 120px;height:120px;">
                                </a>
                            </div>

                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                            <a href="shop-left-sidebar.html">{{ $productBrand->brand->name }}</a>
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
                                    <h4><a class="product_name" href="single-product.html">{{ $productBrand->name }}</a>
                                    </h4>
                                    <div class="price-box">
                                        <span class="new-price">
                                            @if ($productBrand->discount > 0)
                                            <p style="color: red; font-weight:bold;">
                                                {{ number_format($productBrand->price - $productBrand->discount) }}
                                                <span style="text-decoration: underline;">đ</span>
                                            </p>
                                            @else
                                            <p style="color: red; font-weight:bold;">
                                                {{ number_format($productBrand->price) }} <span
                                                    style="text-decoration: underline;">đ</span></p>
                                            @endif

                                        </span>
                                    </div>
                                </div>
                                <div class="add-actions">
                                    <ul class="add-actions-link">
                                        <li class="add-cart active"><a href="#">ĐẶT MUA NGAY</a></li>
                                        <li>
                                            <p productId="{{ $productBrand->id }}" title="quick view"
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
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Laptop Product Area End Here -->
@endsection
