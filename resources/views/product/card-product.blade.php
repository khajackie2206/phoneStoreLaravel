@extends('index')
@section('content')
<!-- Header Area End Here -->
<!-- Begin Li's Breadcrumb Area -->

<div class="breadcrumb-area" style="margin-top: -20px;">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#" id="form-discount">
                    @php $summary = 0; @endphp
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove" style="width: 100px;">Thao tác</th>
                                    <th class="li-product-thumbnail">Hình ảnh</th>
                                    <th class="cart-product-name">Tên sản phẩm</th>
                                    <th class="cart-product-name" style="width: 140px;">Màu sắc</th>
                                    <th class="li-product-price">Giá</th>
                                    <th class="li-product-quantity">Số lượng</th>
                                    <th class="li-product-subtotal">Tổng cộng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (\Illuminate\Support\Facades\Session::get('carts'))
                                @foreach ($products as $product)
                                @php
                                if ($product->discount > 0) {
                                $subTotal = ($product->price - $product->discount) * $carts[$product->id];
                                } else {
                                $subTotal = $product->price * $carts[$product->id];
                                }

                                $summary += $subTotal;
                                @endphp
                                <tr>
                                    <td class="li-product-remove" style="width: 100px;"><a
                                            href="/products/delete-cart/{{ $product->id }}"><i
                                                class="fa fa-times"></i></a></td>
                                    <td class="li-product-thumbnail"><a href="#"><img
                                                src="{{ $product->images->where('type', 'cover')->first()['url'] }}"
                                                style="width: 100px;" alt="Li's Product Image"></a></td>

                                    <td class="li-product-name"><a href="#">{{ $product->name }}
                                        @if($product->category_id !=4 )
                                        {{ $product->rom }}
                                        @endif
                                    </a>
                                    </td>
                                    <td class="li-product-name" style="width: 140px;" name="color"><a href="#">
                                            {{ $product->color }}</a>
                                    </td>
                                    <td class="li-product-price"><span class="amount" style="color: red;">
                                            @if ($product->discount > 0)
                                            {{ number_format($product->price - $product->discount) }}
                                            @else
                                            {{ number_format($product->price) }}
                                            @endif


                                            <span style="text-decoration: underline;">đ</span>
                                        </span></td>
                                    <td class="quantity">

                                        <label>Số lượng</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box"
                                                name="/products/update/{{ $product->id }}"
                                                onchange="changeQuantity(this);" value="{{ $carts[$product->id]}}"
                                                type="text">
                                            <div class="dec qtybutton"
                                                value="/products/adjust/{{ $product->id }}?type=des"
                                                onclick="adjustQuantity(this)"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"
                                                value="/products/adjust/{{ $product->id }}?type=inc"
                                                onclick="adjustQuantity(this)"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span class="amount" style="color: red;">{{
                                            number_format($subTotal) }} <span
                                                style="text-decoration: underline;">đ</span></span></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <input class="input-text" name="discount" placeholder="Mã giảm..." type="text">
                                    <span id="submit-discount"
                                        style="background: #333 none repeat scroll 0 0;border: medium none;border-radius: 0;color: #fff;
                                                                                                         height: 36px;cursor: pointer;margin-left: 6px;padding: 10px 10px;-webkit-transition: all 0.3s ease 0s;transition: all 0.3s ease 0s;width: inherit;">Áp
                                        dụng mã</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Tổng cộng giỏ hàng</h2>
                                <ul>
                                    <li>Tạm tính <span>{{ number_format($summary) }} <span
                                                style="text-decoration: underline;">đ</span></span></li>
                                    <li>Mã giảm
                                        <span>
                                            @if (Session::get('discount') && Session::get('discount')['type'] ==
                                            'money')
                                            <span> - {{ number_format(Session::get('discount')['amount']) }} <span
                                                    style="text-decoration: underline;">đ</span></span>
                                            @elseif(Session::get('discount') && Session::get('discount')['type'] ==
                                            'percent')
                                            - {{ number_format($summary * (Session::get('discount')['amount'] / 100)) }}
                                            <span style="text-decoration: underline;">đ</span>
                                            ({{ Session::get('discount')['amount'] }} %)
                                            @else
                                            0 <span style="text-decoration: underline;">đ</span>
                                            @endif
                                        </span>
                                    </li>
                                    <li>Tổng cộng<span>
                                            @if (Session::get('discount') && Session::get('discount')['type'] ==
                                            'money')
                                            {{ number_format($summary - Session::get('discount')['amount']) }}
                                            @elseif(Session::get('discount') && Session::get('discount')['type'] ==
                                            'percent')
                                            {{ number_format($summary - $summary * (Session::get('discount')['amount'] /
                                            100)) }}
                                            @else
                                            {{ number_format($summary) }}
                                            @endif <span style="text-decoration: underline;">đ</span></span></li>
                                </ul>
                                <a href="/products/checkout">Đi đến thanh toán</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Shopping Cart Area End-->
@endsection
