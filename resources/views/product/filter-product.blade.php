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
                                <select class="nice-select" id="product-sort">
                                    <option value="name" {{ in_array('name', [$sortFilter]) ? 'selected' : '' }}>Tên điện
                                        thoại (A - Z)</option>
                                    <option value="-name" {{ in_array('-name', [$sortFilter]) ? 'selected' : '' }}>Tên
                                        điện thoại (Z - A)</option>
                                    <option value="price" {{ in_array('price', [$sortFilter]) ? 'selected' : '' }}>Mức
                                        giá (Thấp &gt; Cao)</option>
                                    <option value="-price" {{ in_array('-price', [$sortFilter]) ? 'selected' : '' }}>Mức
                                        giá (Cao &gt; Thấp)</option>
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

                                        @if (count($products) == 0)
                                            <div class="col-lg-12 col-md-12 col-sm-12 pt-4">
                                                <div class="alert alert-info text-center" role="alert">
                                                    Không có sản phẩm nào
                                                </div>
                                            </div>
                                        @endif


                                        @foreach ($products as $product)

                                             <?php
                                                $countRating = count($product->comments->where('status', 1));
                                                $avgRating = 0;
                                                $sumRating = 0;
                                                    if ($countRating > 0) {
                                                        foreach ($product->comments->where('status', 1) as $comment) {
                                                            $sumRating += $comment->rating;
                                                        }
                                                    $avgRating = $sumRating / $countRating;
                                                }
                                            ?>
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
                                                                    <li class="{{ $avgRating >= 0.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                    <li class="{{ $avgRating >= 1.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                    <li class="{{ $avgRating >= 2.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                    <li class="{{ $avgRating >= 3.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                    <li class="{{ $avgRating >= 4.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h4><a class="product_name"
                                                                    href="/products/details/{{ $product->id }}">{{ $product->name }}</a>
                                                            </h4>
                                                            <div class="price-box">
                                                                <span class="new-price">
                                                                    @if ($product->discount > 0)
                                                                        <span style="color: red; font-weight:bold;">
                                                                            {{ number_format($product->price - $product->discount) }}
                                                                            <span
                                                                                style="text-decoration: underline;">đ</span>
                                                                        </span>
                                                                        <span
                                                                            style="color: #333; font-weight:bold; font-size: 95%;margin-left: 15px;text-decoration: line-through;">
                                                                            {{ number_format($product->price) }} <span
                                                                                style="text-decoration: underline;">đ</span></span>
                                                                        <span
                                                                            class="discount-percentage">-{{ number_format(($product->discount / $product->price) * 100) }}%</span>
                                                                    @else
                                                                        <p style="color: red; font-weight:bold;">
                                                                            {{ number_format($product->price) }} <span
                                                                                style="text-decoration: underline;">đ</span>
                                                                        </p>
                                                                    @endif
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
                                        @if (count($products) == 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12 pt-4">
                                            <div class="alert alert-info text-center" role="alert">
                                                Không có sản phẩm nào
                                            </div>
                                        </div>
                                        @endif
                                        @foreach ($products as $product)
                                        <?php
                                                                                        $countRating = count($product->comments->where('status', 1));
                                                                                        $avgRating = 0;
                                                                                        $sumRating = 0;
                                                                                            if ($countRating > 0) {
                                                                                                foreach ($product->comments->where('status', 1) as $comment) {
                                                                                                    $sumRating += $comment->rating;
                                                                                                }
                                                                                            $avgRating = $sumRating / $countRating;
                                                                                        }
                                                                                    ?>
                                            <div class="row product-layout-list">
                                                <div class="col-lg-3 col-md-5 ">
                                                    <div class="product-image">
                                                        <a href="/products/details/{{ $product->id }}">
                                                            <img src="{{ $product->images->where('type', 'cover')->first()['url'] }}"
                                                                alt="Li's Product Image"
                                                                style="width: 190px;height:190px;">
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
                                                                      <li class="{{ $avgRating >= 0.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                        <li class="{{ $avgRating >= 1.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                        <li class="{{ $avgRating >= 2.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                        <li class="{{ $avgRating >= 3.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                        <li class="{{ $avgRating >= 4.5 ? '' : 'no-star' }}"><i class="fa fa-star"></i></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h4><a class="product_name"
                                                                    href="single-product.html">{{ $product->name }}</a>
                                                            </h4>
                                                            <div class="price-box">
                                                                <span class="new-price">
                                                                    @if ($product->discount > 0)
                                                                        <span style="color: red; font-weight:bold;">
                                                                            {{ number_format($product->price - $product->discount) }}
                                                                            <span
                                                                                style="text-decoration: underline;">đ</span>
                                                                        </span>
                                                                        <span
                                                                            style="color: #333; font-weight:bold; font-size: 95%;margin-left: 25px;text-decoration: line-through;">
                                                                            {{ number_format($product->price) }} <span
                                                                                style="text-decoration: underline;">đ</span></span>
                                                                        <span
                                                                            class="discount-percentage">-{{ number_format(($product->discount / $product->price) * 100) }}%</span>
                                                                    @else
                                                                        <p style="color: red; font-weight:bold;">
                                                                            {{ number_format($product->price) }} <span
                                                                                style="text-decoration: underline;">đ</span>
                                                                        </p>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <p style="margin-top: 10px;">{{ $product->short_description }}</p>
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
                                @if($productQuantity>6)
                                <a onclick="loadMore()" class="btn btn-light">Xem thêm</a>
                                @endif
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
                        <button class="btn-clear-all mb-sm-30 mb-xs-30"><a href="{{ route('product.filter') }}">Xóa tất
                                cả</a></button>
                        <!-- btn-clear-all end -->
                        <!-- filter-sub-area start -->
                        <form action="{{ route('product.filter') }}" method="GET" id="myForm">
                            <input type="hidden" name="sort" id="sort">
                            <div class="filter-sub-area">
                                <h5 class="filter-sub-titel">Thương hiệu</h5>
                                <div class="categori-checkbox">
                                    <ul>
                                        @foreach ($brands as $brand)
                                            <li class="d-flex align-items-center">
                                                <input type="checkbox" class="feature_checkbox brands brandFilter"
                                                    id="branch-{{ $brand->id }}" value="{{ $brand->id }}"
                                                    {{ in_array($brand->id, $brandFilter) ? 'checked' : '' }}>
                                                <a><label class="mb-0 pb-0"
                                                        for="branch-{{ $brand->id }}">{{ $brand->name }}</label></a>
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
                                            <input type="checkbox" class="priceFilter" value="0;2000000" id="price1"
                                                {{ in_array('0;2000000', $priceFilter) ? 'checked' : '' }}>
                                            <label class="pl-3 mb-0" for="price1">Dưới 2 triệu</label>
                                        </li>
                                        <li class="d-flex align-items-center"><input type="checkbox" class="priceFilter"
                                                value="2000000;4000000" id="price2"
                                                {{ in_array('2000000;4000000', $priceFilter) ? 'checked' : '' }}>
                                            <label class="pl-3 mb-0" for="price2">Từ 2 - 4 triệu</label>
                                        </li>
                                        <li class="d-flex align-items-center"><input type="checkbox" class="priceFilter"
                                                value="4000000;7000000" id="price3"
                                                {{ in_array('4000000;7000000', $priceFilter) ? 'checked' : '' }}>
                                            <label class="pl-3 mb-0" for="price3">Từ 4 - 7 triệu</label>
                                        </li>
                                        <li class="d-flex align-items-center"><input type="checkbox" class="priceFilter"
                                                value="7000000;13000000" id="price4"
                                                {{ in_array('7000000;13000000', $priceFilter) ? 'checked' : '' }}>
                                            <label class="pl-3 mb-0" for="price4">Từ 7 - 13 triệu</label>
                                        </li>
                                        <li class="d-flex align-items-center"><input type="checkbox" class="priceFilter"
                                                value="13000000;20000000" id="price5"
                                                {{ in_array('13000000;20000000', $priceFilter) ? 'checked' : '' }}>
                                            <label class="pl-3 mb-0" for="price5">Từ 13 - 20 triệu</label>
                                        </li>
                                        <li class="d-flex align-items-center"><input type="checkbox" class="priceFilter"
                                                value="20000000;100000000" id="price5"
                                                {{ in_array('20000000;100000000', $priceFilter) ? 'checked' : '' }}>
                                            <label class="pl-3 mb-0" for="price5">Trên 20 triệu</label>
                                        </li>
                                    </ul>
                                </div>
                                <br>
                                <div id="slider" style="font-weight: bold;" class="mt-3 mx-3"></div>
                                <div class="d-flex justify-content-center align-items-center mt-3">
                                    <div class="d-flex flex-column mr-1">
                                        <label style="font-size: 0.8rem">Giá từ</label>
                                        <input type="number" style="font-weight: bold;" id="input-with-keypress-0">
                                    </div>
                                    <div class="d-flex flex-column ml-1">
                                        <label style="font-size: 0.8rem">đến</label>
                                        <input type="number" style="font-weight: bold;" id="input-with-keypress-1">
                                    </div>
                                </div>
                                <input type="hidden" name="filter[price]">
                            </div>



                            <!-- filter-sub-area end -->
                            <!-- filter-sub-area start -->
                            <div class="filter-sub-area pt-sm-10 pt-xs-10">
                                <h5 class="filter-sub-titel">Bộ nhớ trong</h5>
                                <div class="size-checkbox">
                                    <ul>
                                        <li><input type="checkbox" class="product-memories" id="rom1"
                                                value="64 GB" {{ in_array('64 GB', $romFilter) ? 'checked' : '' }}><label
                                                class="ml-2" for="rom1">64 GB</label></li>
                                        <li><input type="checkbox" class="product-memories" id="rom2"
                                                value="128 GB"
                                                {{ in_array('128 GB', $romFilter) ? 'checked' : '' }}><label
                                                class="ml-2" for="rom2">128 GB</label></li>
                                        <li><input type="checkbox" class="product-memories" id="rom3"
                                                value="256 GB"
                                                {{ in_array('256 GB', $romFilter) ? 'checked' : '' }}><label
                                                class="ml-2" for="rom3">256 GB</label></li>
                                        <li><input type="checkbox" class="product-memories" id="rom4"
                                                value="512 GB"
                                                {{ in_array('512 GB', $romFilter) ? 'checked' : '' }}><label
                                                class="ml-2" for="rom4">512 GB</label></li>
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
                                        <li><input type="checkbox" class="phone-types" id="android" value="Android"
                                                {{ in_array('Android', $osFilter) ? 'checked' : '' }}><label
                                                class="ml-2" for="android">Android</label>
                                        </li>
                                        <li><input type="checkbox" class="phone-types" id="ios" value="IOS"
                                                {{ in_array('IOS', $osFilter) ? 'checked' : '' }}><label class="ml-2"
                                                for="ios">iOS</label>
                                        </li>
                                        <li><input type="checkbox" class="phone-types" id="other_phone" value="Other"
                                                {{ in_array('Other', $osFilter) ? 'checked' : '' }}><label class="ml-2"
                                                for="other_phone">Điện
                                                thoại phổ thông</label></li>
                                    </ul>
                                    <input type="hidden" name="filter[os]">
                                </div>
                            </div>

                            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                                <h5 class="filter-sub-titel">Danh mục</h5>
                                <div class="categori-checkbox">
                                    <ul>
                                       @foreach ($categories as $category)
                                    <li class="d-flex align-items-center">
                                        <input type="checkbox" class="feature_checkbox category categoryFilter" id="category-{{ $category->id }}"
                                            value="{{ $category->id }}" {{ in_array($category->id, $categoryFilter) ? 'checked' : '' }}>
                                        <a><label class="mb-0 pb-0" for="category-{{ $category->id }}">{{ $category->name }}</label></a>
                                    </li>
                                    @endforeach
                                    </ul>
                                    <input type="hidden" name="filter[category]">
                                </div>
                            </div>


                            <button class="btn-primary mb-sm-30 mb-xs-30"
                                style="border: none; border-radius: 2px; padding: 3px 15px 3px 15px;cursor: pointer;"
                                id="btnSearch">Tìm kiếm</button>
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
        $(document).ready(function() {

            $(document).on("click", ".quick-view-btn", function(){

            });

            //slider
            var slider = document.getElementById('slider');
            var input0 = document.getElementById('input-with-keypress-0');
            var input1 = document.getElementById('input-with-keypress-1');
            var inputs = [input0, input1];

            noUiSlider.create(slider, {
                connect: true,
                range: {
                    'min': 0,
                    '10%': 10,
                    '15%': 15,
                    '20%': 20,
                    '25%': 25,
                    '30%': 30,
                    '35%': 35,
                    '40%': 40,
                    '45%': 45,
                    '50%': 50,
                    '55%': 55,
                    '60%': 60,
                    '65%': 65,
                    '70%': 70,
                    '75%': 75,
                    '80%': 80,
                    '85%': 85,
                    '90%': 90,
                    '95%': 95,
                    'max': 100
                },
                tooltips: true,
                start: [0, 100],
            });


            function changeValueOfPriceFilter(priceRange) {
                //remove all check of input with class priceFilter
                $('.priceFilter').prop('checked', false);
                //convert priceRange to string
                priceRange = priceRange.from * 1000000 + ';' + priceRange.to * 1000000;
                $('input[name="filter[price]"]').val(priceRange);
            }
            slider.noUiSlider.on('update', function(values, handle) {
                inputs[handle].value = values[handle];
            });

            slider.noUiSlider.on('change', function(values, handle) {
                changeValueOfPriceFilter({
                    'from': values[0],
                    'to': values[1]
                });
                inputs[handle].value = values[handle];
            });


            inputs.forEach(function(input, handle) {
                input.addEventListener('change', function() {
                    slider.noUiSlider.setHandle(handle, this.value);
                    let from = $('#input-with-keypress-0').val();
                    let to = $('#input-with-keypress-1').val();
                    changeValueOfPriceFilter({
                        'from': from,
                        'to': to
                    });
                });

                input.addEventListener('keydown', function(e) {

                    var values = slider.noUiSlider.get();

                    var value = Number(values[handle]);

                    // [[handle0_down, handle0_up], [handle1_down, handle1_up]]
                    var steps = slider.noUiSlider.steps();

                    // [down, up]
                    var step = steps[handle];

                    var position;

                    // 13 is enter,
                    // 38 is key up,
                    // 40 is key down.
                    switch (e.which) {

                        case 13:
                            slider.noUiSlider.setHandle(handle, this.value);
                            break;

                        case 38:

                            // Get step to go increase slider value (up)
                            position = step[1];

                            // false = no step is set
                            if (position === false) {
                                position = 1;
                            }

                            // null = edge of slider
                            if (position !== null) {
                                slider.noUiSlider.setHandle(handle, value + position);
                            }

                            break;

                        case 40:

                            position = step[0];

                            if (position === false) {
                                position = 1;
                            }

                            if (position !== null) {
                                slider.noUiSlider.setHandle(handle, value - position);
                            }

                            break;
                    }
                });
            });

            //slider

            var sort = $('#product-sort :selected').val();
            $('#sort').val(sort);
            //when select with id product-sort change value, alert value
            $('#product-sort').change(function() {
                $('input[name="sort"]').val($(this).val());
            });
            $('#btnSearch').click(function(e) {
                //prevent form submit
                e.preventDefault();
                //get value of all input with class is brandFilter

                var brandFilter = $('.brandFilter:checked').map(function() {
                    return $(this).val();
                }).get();
                //convert brands to string with -
                var brandString = brandFilter.join('-');
                //assign value of input with name is filter[brand] with value is brandString
                //check of value of brandString is not empty
                if (brandString != '') {
                    $('input[name="filter[brand]"]').val(brandString);
                } else {
                    $('input[name="filter[brand]"]').remove();
                }

                //get value of all input with class name is priceFilter and add it to array with -
                var priceFilter = $('.priceFilter:checked').map(function() {
                    return $(this).val();
                }).get();
                var priceString = priceFilter.join('-');
                if (priceString != '') {
                    $('input[name="filter[price]"]').val(priceString);
                }
                //get value of all input with class name is product-memories and add it to array with -
                var productMemories = $('.product-memories:checked').map(function() {
                    return $(this).val();
                }).get();
                var productMemoriesString = productMemories.join('-');
                if (productMemoriesString != '') {
                    $('input[name="filter[rom]"]').val(productMemoriesString);
                } else {
                    $('input[name="filter[rom]"]').remove();
                }
                //get value of all input with class name is phone-types and add it to array with -
                var phoneTypes = $('.phone-types:checked').map(function() {
                    return $(this).val();
                }).get();
                var phoneTypesString = phoneTypes.join(',');
                if (phoneTypesString != '') {
                    $('input[name="filter[os]"]').val(phoneTypesString);
                } else {
                    $('input[name="filter[os]"]').remove();
                }

                //get value of all input with class name is categoryFilter and add it to array with -
                var phoneTypes = $('.categoryFilter:checked').map(function() {
                return $(this).val();
                }).get();
                var phoneCategoryString = phoneTypes.join(',');
                if (phoneCategoryString != '') {
                $('input[name="filter[category]"]').val(phoneCategoryString);
                } else {
                $('input[name="filter[category]"]').remove();
                }
                //submit form
                $('#myForm').submit();
            });
        });
    </script>
@stop
