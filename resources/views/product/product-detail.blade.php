@extends('index')
@section('content')
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
                                        <img src="{{ $image->url }}" alt="product image">
                                    </a>
                                </div>
                            @endforeach
                            @foreach ($product->images as $image)
                                <div class="lg-image">
                                    <a class="popup-img venobox vbox-item" href="{{ $image->url }}" data-gall="myGallery">
                                        <img src="{{ $image->url }}" alt="product image">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="product-details-thumbs slider-thumbs-1" style="margin-top: 50px;">

                            @foreach ($product->images as $image)
                                <div class="sm-image"><img src="{{ $image->url }}" alt="product image thumb"></div>
                            @endforeach

                            @foreach ($product->images as $image)
                                <div class="sm-image"><img src="{{ $image->url }}" alt="product image thumb"></div>
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
                                        @if ($item->memories[0]['rom'] == $product->memories[0]['rom'])
                                            <a href="/products/details/{{ $item->id }}"
                                                style="border: solid #0363cd 1px;font-size: 15px; padding: 10px; ">{{ $item->ram }}
                                                GB - {{ $item->memories[0]['rom'] }} GB</a>
                                        @else
                                            <a href="/products/details/{{ $item->id }}"
                                                style="border: 1px solid #e0e0e0;font-size: 15px; padding: 10px; color: #333; ">{{ $item->ram }}
                                                GB - {{ $item->memories[0]['rom'] }} GB</a>
                                        @endif
                                    @endforeach

                                </span></h2>
                            <span class="product-details-ref">Thương hiệu: {{ $product->brand->name }}</span>
                            <div class="rating-box pt-20">
                                <ul class="rating rating-with-review-item">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <li><a href="#" style="color: #2f80ed;font-size: 9pt;">606 Đánh
                                            giá</a></li>
                                </ul>
                            </div>
                            <div class="price-box pt-20">
                                <span class="new-price new-price-2">{{ number_format($product->price) }} <span
                                        style="text-decoration: underline;">đ</span></span>
                            </div>
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
                                        <label>Màu sắc</label>
                                        <select class="nice-select" name="color">
                                            @foreach ($product->colors as $item)
                                                <option value="{{ $item->id }}" title="{{ $item->name }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="single-add-to-cart" style="margin-top: 25px;">

                                    <div class="quantity">
                                        <label>Số lượng</label>
                                        <div class="cart-plus-minus card-plus-minus-plus">
                                            <input class="cart-plus-minus-box" value="1" type="text"
                                                id="product-quantity" name="quantity">
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
                                @csrf
                            </form>
                            <div class="product-additional-info pt-25">
                                <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Yêu thích</a>
                                <div class="product-social-sharing pt-25">
                                    <ul>
                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a>
                                        </li>
                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a>
                                        </li>
                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google
                                                +</a></li>
                                        <li class="instagram"><a href="#"><i
                                                    class="fa fa-instagram"></i>Instagram</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="block-reassurance" style="margin-top: 40px;">
                                <ul>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <p>Nhận hàng trong vòng 3 - 7 ngày</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            <p> Bảo hành chính hãng trong vòng 24 tháng</p>
                                        </div>
                                    </li>
                                </ul>
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
                            <li><a class="active" data-toggle="tab" href="#description"><span>Thông tin sản
                                        phẩm</span></a></li>
                            <li><a data-toggle="tab" href="#product-details"><span>Cấu hình chi tiết</span></a></li>
                            <li><a data-toggle="tab" href="#reviews"><span>Đánh giá sản phẩm</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="description" class="tab-pane active show" role="tabpanel">
                    <div class="product-description">
                        <span>
                            {!! $product->description !!}
                        </span>
                    </div>
                </div>
                <div id="product-details" class="tab-pane" role="tabpanel">
                    <div class="product-details-manufacturer">
                        <table class="table table-striped"
                            style="width: 800px;margin: auto; margin-top: 20px; margin-bottom: -100px;">
                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h5>Màn hình</h5>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Công nghệ màn hình: </td>
                                <td>{{ $product->display_tech }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Độ phân giải: </td>
                                <td>{{ $product->resolution }}</td>
                            <tr>
                                <td style="font-weight: bold;">Kích thước: </td>
                                <td>{{ $product->size }} "</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Tần số quét: </td>
                                <td>{{ $product->screen_rate }}</td>
                            </tr>
                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h5>Camera</h5>
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
                                    <h5>Hệ điều hành & CPU</h5>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Hệ điều hành: </td>
                                <td>{{ $product->os }}</td>
                            <tr>
                                <td style="font-weight: bold;">Chip xử lý: </td>
                                <td>{{ $product->cpu }}</td>
                            </tr>
                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h5>Bộ nhớ & Lưu trữ</h5>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">RAM: </td>
                                <td>{{ $product->ram }} GB</td>
                            <tr>
                                <td style="font-weight: bold;">Bộ nhớ trong: </td>
                                <td>{{ $product->memories[0]['rom'] }} GB</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Dung lượng còn lại: </td>
                                <td>{{ $product->memories[0]['rom'] - 20 }} GB</td>
                            </tr>
                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h5>Pin</h5>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Dung lượng pin: </td>
                                <td>{{ $product->battery }} mAh</td>
                            <tr>
                                <td style="font-weight: bold;">Công nghệ pin: </td>
                                <td style="color: rgb(66, 90, 224);">Li-Po</td>
                            </tr>
                            <tr style="background-color: #f1f1f1;">
                                <th colspan="2">
                                    <h5>Thông tin chung</h5>
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
                <div id="reviews" class="tab-pane" role="tabpanel">
                    <div class="product-reviews">
                        <div class="product-details-comment-block">
                            <div class="comment-review">
                                <span>Mức độ hài lòng</span>
                                <ul class="rating">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                            <div class="comment-author-infos pt-25">
                                <span>Nguyễn Minh Kha</span>
                                <em>01-12-22</em>
                            </div>
                            <div class="comment-details">
                                <h4 class="title-block">Chất lượng tốt</h4>
                                <p>Sản phẩm chất lượng tốt, phù hợp giá tiền</p>
                            </div>
                            <div class="review-btn">
                                <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Viết
                                    đánh giá</a>
                            </div>
                            <!-- Begin Quick View | Modal Area -->
                            <div class="modal fade modal-wrapper" id="mymodal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h3 class="review-page-title">Write Your Review</h3>
                                            <div class="modal-inner-area row">
                                                <div class="col-lg-6">
                                                    <!-- Product Details Left -->
                                                    <div class="product-details-left">
                                                        <div class="product-details-images slider-navigation-1">
                                                            @foreach ($product->images as $image)
                                                                <div class="lg-image">
                                                                    <img src="{{ $image->url }}" alt="product image">
                                                                </div>
                                                            @endforeach
                                                            @foreach ($product->images as $image)
                                                                <div class="lg-image">
                                                                    <img src="{{ $image->url }}" alt="product image">
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                        <div class="product-details-thumbs slider-thumbs-1">
                                                            @foreach ($product->images as $image)
                                                                <div class="sm-image"><img src="{{ $image->url }}"
                                                                        alt="product image thumb"></div>
                                                            @endforeach
                                                            @foreach ($product->images as $image)
                                                                <div class="sm-image"><img src="{{ $image->url }}"
                                                                        alt="product image thumb"></div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <!--// Product Details Left -->
                                                    <div class="li-review-product">
                                                        <img src="images/product/large-size/3.jpg" alt="Li's Product">
                                                        <div class="li-review-product-desc">
                                                            <p class="li-product-name">Today is a good day Framed poster
                                                            </p>
                                                            <p>
                                                                <span>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                                    Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                                    Room With Exquisite Sound via Ring Radiator Technology.
                                                                    Stream And Control R3 Speakers Wirelessly With Your
                                                                    Smartphone. Sophisticated, Modern Design </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="li-review-content">
                                                        <!-- Begin Feedback Area -->
                                                        <div class="feedback-area">
                                                            <div class="feedback">
                                                                <h3 class="feedback-title">Our Feedback</h3>
                                                                <form action="#">
                                                                    <p class="your-opinion">
                                                                        <label>Your Rating</label>
                                                                        <span>
                                                                            <select class="star-rating">
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>
                                                                        </span>
                                                                    </p>
                                                                    <p class="feedback-form">
                                                                        <label for="feedback">Your Review</label>
                                                                        <textarea id="feedback" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                                    </p>
                                                                    <div class="feedback-input">
                                                                        <p class="feedback-form-author">
                                                                            <label for="author">Name<span
                                                                                    class="required">*</span>
                                                                            </label>
                                                                            <input id="author" name="author"
                                                                                value="" size="30"
                                                                                aria-required="true" type="text">
                                                                        </p>
                                                                        <p
                                                                            class="feedback-form-author feedback-form-email">
                                                                            <label for="email">Email<span
                                                                                    class="required">*</span>
                                                                            </label>
                                                                            <input id="email" name="email"
                                                                                value="" size="30"
                                                                                aria-required="true" type="text">
                                                                            <span class="required"><sub>*</sub> Required
                                                                                fields</span>
                                                                        </p>
                                                                        <div class="feedback-btn pb-15">
                                                                            <a href="#" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">Close</a>
                                                                            <a href="#">Submit</a>
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
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-30 pb-50" style="margin-bottom: 105px;">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12" style="margin-top: 150px;">
                    <div class="li-section-title" style="margin-bottom: 50px;">
                        <h2>
                            <span>{{ count($productBrands) }} sản phẩm khác liên quan: </span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($productBrands as $productBrand)
                                <div class="col-lg-12">
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
                                                        <a
                                                            href="shop-left-sidebar.html">{{ $productBrand->brand->name }}</a>
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
                                                        href="single-product.html">{{ $productBrand->name }}</a></h4>
                                                <div class="price-box">
                                                    <span class="new-price">
                                                        <p style="color: red; font-weight:bold;">
                                                            {{ number_format($productBrand->price) }} đ</p>
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
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Laptop Product Area End Here -->
@endsection
