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
    <div class="content-wraper pt-30 pb-60 pt-sm-30">
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
                                                                    <a
                                                                        href="/products/details/{{ $product->id }}">{{ $product->brand->name }}</a>
                                                                </h5>
                                                                <div class="rating-box">
                                                                    <ul class="rating">
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h4><a class="product_name"
                                                                    href="/products/details/{{ $product->id }}">{{ $product->name }}</a>
                                                            </h4>
                                                            <div class="price-box">
                                                                <span class="new-price">
                                                                    <p style="color: red; font-weight:bold;">
                                                                        {{ number_format($product->price) }} đ</p>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="add-actions">
                                                            <ul class="add-actions-link">
                                                                <li class="add-cart active"><a
                                                                        href="/products/details/{{ $product->id }}">ĐẶT
                                                                        MUA NGAY</a></li>
                                                                <li>
                                                                    <p productId="{{ $product->id }}" title="quick view"
                                                                        class="quick-view-btn" data-toggle="modal"
                                                                        data-target="#exampleModalCenter"><i
                                                                            class="fa fa-eye"></i>
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
                            <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
                                <div class="row">
                                    <div class="col" id="flexProduct">
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
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h4><a class="product_name"
                                                                    href="single-product.html">{{ $product->name }}</a>
                                                            </h4>
                                                            <div class="price-box">
                                                                <span class="new-price">
                                                                    <p style="color: red; font-weight:bold;">
                                                                        {{ number_format($product->price) }} đ</p>
                                                                </span>
                                                            </div>
                                                            <p>{{ $product->short_description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="shop-add-action mb-xs-30">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart"><a
                                                                    href="/products/details/{{ $product->id }}">ĐẶT MUA
                                                                    NGAY</a></li>
                                                            <li><a class="quick-view quick-view-btn"
                                                                    productId="{{ $product->id }}" data-toggle="modal"
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
                            <div class="paginate" style="text-align: center; margin-top: 45px;" id="button-loadMore">
                                <input type="hidden" value="1" id="page">
                                <a onclick="loadMore()" class="btn btn-light">Xem thêm</a>
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
                        <form action="{{route('product.filter')}}" method="GET" id="myForm">
                            <div class="filter-sub-area">
                                <h5 class="filter-sub-titel">Thương hiệu</h5>
                                <div class="categori-checkbox">
                                    <ul>
                                        @foreach ($brands as $brand)
                                            <li class="d-flex align-items-center">
                                                <input type="checkbox" class="feature_checkbox brands brandFilter"
                                                       id="branch-{{$brand->id}}"
                                                       value="{{ $brand->id }}"
                                                {{ in_array($brand->id, $brandFilter) ? 'checked' : '' }}>
                                                <a><label class="mb-0 pb-0" for="branch-{{$brand->id}}">{{ $brand->name }}</label></a>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <input type="hidden" name="filter[brand]">
                                </div>
                            </div>
                            <!-- filter-sub-area end -->
                            <!-- filter-sub-area start -->
                            <div class="filter-sub-area pt-sm-10 pt-xs-10">
                                <h5 class="filter-sub-titel">Mức giá</h5>
                                <div class="size-checkbox">
                                    <ul>
                                        <li class="d-flex align-items-center">
                                            <input type="checkbox" class="priceFilter" value="0,2000000" id="price1"
                                            {{ in_array('0,2000000', [$priceFilter]) ? 'checked' : '' }}
                                            >
                                            <label class="pl-3 mb-0" for="price1">Dưới 2 triệu</label></li>
                                        <li class="d-flex align-items-center"><input type="checkbox" class="priceFilter"  value="2000000,4000000" id="price2"
                                                {{ in_array('2000000,4000000', [$priceFilter]) ? 'checked' : '' }}
                                            >
                                            <label class="pl-3 mb-0" for="price2">Từ 2 - 4 triệu</label></li>
                                        <li class="d-flex align-items-center"><input type="checkbox" class="priceFilter"  value="4000000,7000000" id="price3"
                                                {{ in_array('4000000,7000000', [$priceFilter]) ? 'checked' : '' }}
                                            >
                                            <label class="pl-3 mb-0" for="price3">Từ 4 - 7 triệu</label></li>
                                        <li class="d-flex align-items-center"><input type="checkbox" class="priceFilter"  value="7000000,13000000" id="price4"
                                                {{ in_array('7000000,13000000', [$priceFilter]) ? 'checked' : '' }}
                                            >
                                            <label class="pl-3 mb-0" for="price4">Từ 7 - 13 triệu</label></li>
                                        <li class="d-flex align-items-center"><input type="checkbox" class="priceFilter" value="13000000,20000000" id="price5"
                                                {{ in_array('13000000,20000000', [$priceFilter]) ? 'checked' : '' }}
                                            >
                                            <label class="pl-3 mb-0" for="price5">Từ 13 - 20 triệu</label></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="filter[price]">
                            </div>
                            <!-- filter-sub-area end -->
                            <!-- filter-sub-area start -->
                            <div class="filter-sub-area pt-sm-10 pt-xs-10">
                                <h5 class="filter-sub-titel">Bộ nhớ trong</h5>
                                <div class="size-checkbox">
                                    <ul>
                                        <li><input type="checkbox" class="product-memories" id="rom1" value="64 GB"><label for="rom1">64 GB</label></li>
                                        <li><input type="checkbox" class="product-memories" id="rom2" value="128 GB"><label for="rom2">128 GB</label></li>
                                        <li><input type="checkbox" class="product-memories" id="rom3"  value="256 GB"><label for="rom3" >256 GB</label></li>
                                        <li><input type="checkbox" class="product-memories" id="rom4" value="512 GB"><label for="rom4" >512 GB</label></li>
                                    </ul>
                                    <input type="hidden" name="filter[rom]">
                                </div>
                            </div>
                            <!-- filter-sub-area end -->
                            <!-- filter-sub-area start -->
                            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                                <h5 class="filter-sub-titel">Loại điện thoại</h5>
                                <div class="categori-checkbox">
                                    <ul>
                                        <li><input type="checkbox" class="phone-types" name="phone-types[]"
                                                value="Android"><a href="#">Android</a>
                                        </li>
                                        <li><input type="checkbox" class="phone-types" name="phone-types[]"
                                                value="IOS"><a href="#">iOS</a>
                                        </li>
                                        <li><input type="checkbox" class="phone-types" name="phone-types[]"
                                                value="Other"><a href="#">Điện
                                                thoại phổ thông</a></li>
                                    </ul>
                                </div>
                            </div>

                            <button class="btn-primary mb-sm-30 mb-xs-30" id="btnSearch">Tìm kiếm</button>
                        </form>

                        <!-- filter-sub-area end -->
                    </div>
                    <!--sidebar-categores-box end  -->

                </div>
            </div>
        </div>
    </div>
    <!-- Content Wraper Area End Here -->
@endsection

@section('scripts')
    <script>
        $( document ).ready(function() {
           //when button with id btnSearch click, get value of input with name is brands[] and log it
            $('#btnSearch').click(function(e){
                //prevent form submit
                e.preventDefault();
                //get value of all input with class is brandFilter

                var brandFilter = $('.brandFilter:checked').map(function(){
                    return $(this).val();
                }).get();
                //convert brands to string with -
                var brandString = brandFilter.join('-');
                //assign value of input with name is filter[brand] with value is brandString
                //check of value of brandString is not empty
                if(brandString != ''){
                    $('input[name="filter[brand]"]').val(brandString);
                }
                else{
                    $('input[name="filter[brand]"]').remove();
                }

                //get value of all input with class name is priceFilter and add it to array with -
                var priceFilter = $('.priceFilter:checked').map(function(){
                    return $(this).val();
                }).get();
                var priceString = priceFilter.join('-');
                if(priceString != ''){
                    $('input[name="filter[price]"]').val(priceString);
                }
                else{
                    $('input[name="filter[price]"]').remove();
                }
                //get value of all input with class name is product-memories and add it to array with -
                var productMemories = $('.product-memories:checked').map(function(){
                    return $(this).val();
                }).get();
                var productMemoriesString = productMemories.join('-');
                if(productMemoriesString != ''){
                    $('input[name="filter[rom]"]').val(productMemoriesString);
                }
                else{
                    $('input[name="filter[rom]"]').remove();
                }
                //submit form
                $('#myForm').submit();
            });
        });
    </script>
@stop
