@extends('index')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area" style="margin-top: -20px;">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li class="active">Danh sách sản phẩm</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Li's Content Wraper Area -->
    <div class="content-wraper pt-60 pb-60 pt-sm-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-1 order-lg-2">

                    <!-- shop-top-bar start -->
                    <div class="shop-top-bar">
                        <div class="shop-bar-inner">
                            <div class="product-view-mode">
                                <!-- shop-item-filter-list start -->
                                <ul class="nav shop-item-filter-list" role="tablist">
                                    <li class="active" role="presentation"><a aria-selected="true" class="active show"
                                            data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i
                                                class="fa fa-th"></i></a></li>
                                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view"
                                            href="#list-view"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                                <!-- shop-item-filter-list end -->
                            </div>
                        </div>
                        <!-- product-select-box start -->
                        <div class="product-select-box">
                            <div class="product-short">
                                <p>Sắp xếp theo:</p>
                                <select class="nice-select">
                                    <option value="sales">Tên điện thoại (A - Z)</option>
                                    <option value="sales">Tên điện thoại (Z - A)</option>
                                    <option value="rating">Mức giá (Thấp &gt; Cao)</option>
                                    <option value="rating">Mức giá (Cao &gt; Thấp)</option>
                                    <option value="date">Bán chạy nhất</option>
                                </select>
                            </div>
                        </div>
                        <!-- product-select-box end -->
                    </div>
                    <!-- shop-top-bar end -->
                    <!-- shop-products-wrapper start -->
                    <div class="shop-products-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                <div class="product-area shop-product-area">
                                    <div class="row" id="filterArea">
                                    @foreach ($products as $product)
                                 
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="/products/details/{{ $product->id }}">
                                                         <img src="{{ $product->images->where('type', 'cover')->first()['url'] }}"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    </a>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="/products/details/{{ $product->id }}">{{ $product->brand->name }}</a>
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
                                                        <h4><a class="product_name" href="/products/details/{{ $product->id }}">{{ $product->name}}</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price"> <p style="color: red; font-weight:bold;">
                                                            {{ number_format($product->price) }} đ</p></span>
                                                        </div>
                                                    </div>
                                                  <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="/products/details/{{ $product->id }}">ĐẶT MUA NGAY</a></li>
                                                    <li>
                                                        <p productId="{{ $product->id }}" title="quick view"
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
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                        <img src="/storage/uploads/2022/09/03/iphone-13-starlight-1-600x600.jpg"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.html">Graphic Corner</a>
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
                                                        <h4><a class="product_name" href="single-product.html">Accusantium
                                                                dolorem1</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="shopping-cart.html">Add
                                                                    to cart</a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                        <img src="/storage/uploads/2022/09/03/iphone-13-starlight-1-600x600.jpg"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.html">Graphic Corner</a>
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
                                                        <h4><a class="product_name" href="single-product.html">Accusantium
                                                                dolorem1</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="shopping-cart.html">Add
                                                                    to cart</a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                        <img src="/storage/uploads/2022/09/03/iphone-13-starlight-1-600x600.jpg"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.html">Graphic Corner</a>
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
                                                        <h4><a class="product_name" href="single-product.html">Accusantium
                                                                dolorem1</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="shopping-cart.html">Add
                                                                    to cart</a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                         <img src="/storage/uploads/2022/09/03/iphone-13-starlight-1-600x600.jpg"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.html">Graphic Corner</a>
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
                                                        <h4><a class="product_name" href="single-product.html">Accusantium
                                                                dolorem1</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="shopping-cart.html">Add
                                                                    to cart</a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                        <img src="/storage/uploads/2022/09/03/iphone-13-starlight-1-600x600.jpg"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.html">Graphic Corner</a>
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
                                                        <h4><a class="product_name" href="single-product.html">Accusantium
                                                                dolorem1</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="shopping-cart.html">Add
                                                                    to cart</a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                        <img src="/storage/uploads/2022/09/03/iphone-13-starlight-1-600x600.jpg"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.html">Graphic Corner</a>
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
                                                        <h4><a class="product_name" href="single-product.html">Accusantium
                                                                dolorem1</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="shopping-cart.html">Add
                                                                    to cart</a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                        <img src="/storage/uploads/2022/09/03/iphone-13-starlight-1-600x600.jpg"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.html">Graphic Corner</a>
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
                                                        <h4><a class="product_name" href="single-product.html">Accusantium
                                                                dolorem1</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="shopping-cart.html">Add
                                                                    to cart</a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                        <img src="/storage/uploads/2022/09/03/iphone-13-starlight-1-600x600.jpg"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.html">Graphic Corner</a>
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
                                                        <h4><a class="product_name" href="single-product.html">Accusantium
                                                                dolorem1</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="shopping-cart.html">Add
                                                                    to cart</a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                        <img src="/storage/uploads/2022/09/03/iphone-13-starlight-1-600x600.jpg"
                                                    alt="Li's Product Image" style="width: 120px;height:120px;">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.html">Graphic Corner</a>
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
                                                        <h4><a class="product_name" href="single-product.html">Accusantium
                                                                dolorem1</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="shopping-cart.html">Add
                                                                    to cart</a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
                                <div class="row">
                                    <div class="col">
                                        @foreach ($products as $product)
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                               <div class="product-image">
                                                    <a href="/products/details/{{ $product->id }}">
                                                         <img src="{{ $product->images->where('type', 'cover')->first()['url'] }}"
                                                    alt="Li's Product Image" style="width: 190px;height:190px;">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="#">{{ $product->brand->name }}</a>
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
                                                        <h4><a class="product_name" href="single-product.html">{{ $product->name}}</a></h4>
                                                        <div class="price-box">
                                                             <span class="new-price"> <p style="color: red; font-weight:bold;">
                                                            {{ number_format($product->price) }} đ</p></span>
                                                        </div>
                                                        <p>{{ $product->short_description}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="/products/details/{{ $product->id }}">ĐẶT MUA NGAY</a></li>
                                                        <li><a class="quick-view quick-view-btn" productId="{{ $product->id }}" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Xem chi tiết</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                         @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="paginatoin-area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 pt-xs-15">
                                        <p>Kết quả 1-12 của 13 sản phẩm</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul class="pagination-box pt-xs-20 pb-xs-15">
                                            <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i>
                                                    Previous</a>
                                            </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li>
                                                <a href="#" class="Next"> Next <i
                                                        class="fa fa-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop-products-wrapper end -->
                </div>
                <div class="col-lg-3 order-2 order-lg-1">

                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box">
                        <div class="sidebar-title">
                            <h2>Lọc sản phẩm</h2>
                        </div>
                        <!-- btn-clear-all start -->
                        <button class="btn-clear-all mb-sm-30 mb-xs-30">Xóa tất cả</button>
                        <!-- btn-clear-all end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area">
                            <h5 class="filter-sub-titel">Thương hiệu</h5>
                            <div class="categori-checkbox">
                                <form action="#">
                                    <ul>
                                        @foreach ($brands as $brand)
                                            <li><input type="checkbox"  class="feature_checkbox" name="product-categori" id="{{$brand->id}}"><a href="#">{{ $brand->name}}</a></li>
                                        @endforeach
                                        
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Tính năng đặc biệt</h5>
                            <div class="categori-checkbox">
                                <form action="#">
                                    <ul>
                                        @foreach ($features as $feature)
                                            <li><input type="checkbox" name="product-categori" ><a href="#">{{ $feature->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Mức giá</h5>
                            <div class="size-checkbox">
                                <form action="#">
                                    <ul>
                                        <li><input type="checkbox" name="product-size"><a href="#">Dưới 2
                                                triệu</a></li>
                                        <li><input type="checkbox" name="product-size"><a href="#">Từ 2 - 4
                                                triệu</a></li>
                                        <li><input type="checkbox" name="product-size"><a href="#">Từ 4 - 7
                                                triệu</a></li>
                                        <li><input type="checkbox" name="product-size"><a href="#">Từ 7 - 13
                                                triệu</a></li>
                                        <li><input type="checkbox" name="product-size"><a href="#">Từ 13 - 20
                                                triệu</a></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Bộ nhớ trong</h5>
                            <div class="size-checkbox">
                                <form action="#">
                                    <ul>
                                         <li><input type="checkbox" name="product-size"><a href="#">64 GB</a></li>
                                         <li><input type="checkbox" name="product-size"><a href="#">128 GB</a></li>
                                         <li><input type="checkbox" name="product-size"><a href="#">256 GB</a></li>
                                         <li><input type="checkbox" name="product-size"><a href="#">512 GB</a></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                            <h5 class="filter-sub-titel">Loại điện thoại</h5>
                            <div class="categori-checkbox">
                                <form action="#">
                                    <ul>
                                        <li><input type="checkbox" name="product-categori"><a
                                                href="#">Android</a></li>
                                        <li><input type="checkbox" name="product-categori"><a href="#">iOS</a>
                                        </li>
                                        <li><input type="checkbox" name="product-categori"><a href="#">Điện
                                                thoại phổ thông</a></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                    </div>
                    <!--sidebar-categores-box end  -->

                </div>
            </div>
        </div>
    </div>
    <!-- Content Wraper Area End Here -->
@endsection
