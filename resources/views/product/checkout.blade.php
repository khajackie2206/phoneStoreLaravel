@extends('index')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li class="active">Thanh toán</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Checkout Area Strat-->
    <div class="checkout-area pt-60 pb-30">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-12">
                    <form action="#">
                        <div class="checkbox-form">
                            <h3>Thông tin giao hàng</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Họ và tên <span class="required">*</span></label>
                                        <input value="{{ $user->name }}" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ giao hàng <span class="required">*</span></label>
                                        <input placeholder="Địa chỉ giao hàng" value=""
                                            type="text">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Giới tính<span class="required">*</span></label>
                                        <input type="text" value="" placeholder="Giới tính">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email <span class="required">*</span></label>
                                        <input placeholder="Địa chỉ mail" value="{{ $user->email }}" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại giao hàng <span class="required">*</span></label>
                                        <input type="text" value="" placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list create-acc">
                                        <input id="cbox" type="checkbox">
                                        <label>Tôi đã đọc và đồng ý điều khoản</label>
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label>Giao đến địa chỉ mới?</label>
                                        <input id="ship-box" type="checkbox">
                                    </h3>
                                </div>
                                <div id="ship-box-info" class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Địa chỉ giao hàng mới <span class="required">*</span></label>
                                            <input placeholder="Street address" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Ghi chú giao hàng</label>
                                        <textarea id="checkout-mess" cols="30" rows="10"
                                            placeholder="Ghi chú thông tin như giao hàng nhanh, hàng dễ vỡ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-12">
                    @php $summary = 0; @endphp
                    <div class="your-order">
                        <h3 style="text-align: center;">Đơn hàng của bạn</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name">Sản phẩm</th>
                                        <th class="cart-product-total">Tổng cộng</th>
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
                                                <tr class="cart_item">
                                                    <td class="cart-product-name"> {{ $product->name }}<strong
                                                            class="product-quantity"> × {{ $carts[$product->id]}}</strong>
                                                    </td>
                                                    <td class="cart-product-total">
                                                        <span class="amount">
                                                            {{ number_format(( $product->discount > 0 ? ($product->price - $product->discount) : $product->price ) * $carts[$product->id]) }}
                                                            <span style="text-decoration: underline;">đ</span></span>
                                                    </td>
                                                </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Tạm tính</th>
                                        <td><span class="amount">{{ number_format($summary) }} <span
                                                    style="text-decoration: underline;">đ</span></span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Tổng cộng</th>
                                        <td><strong><span class="amount">{{ number_format($summary) }}</span></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="#payment-1">
                                            <h5 class="panel-title">
                                                <a class="" data-toggle="collapse" data-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    Mã giảm giá
                                                </a>
                                            </h5>
                                        </div>
                                        <div>
                                            <div class="card-body">
                                                <div class="justify-content-center">
                                                    <div class="coupon-info">
                                                        <form action="#" style="margin-top: 15px;margin-bottom: 15px;">
                                                            <p class="checkout-coupon">
                                                                <input placeholder="Coupon code" type="text"
                                                                    style="margin-left: 50px;margin-right: 85px;">
                                                                <input value="Apply Coupon" type="submit">
                                                            </p>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="margin-top: 15px;">
                                        <div>
                                            <h5 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Phương thức thanh toán
                                                </a>
                                            </h5>
                                        </div>
                                        <div>
                                            <form action="/action_page.php" style="margin-top: 15px;">
                                                <input type="radio" id="html" name="fav_language" value="HTML"
                                                    style="height: 20px; width: 18%;">
                                                <label for="html"> <span class="amount"
                                                        style="font-weight: bold;">Thanh toán khi nhận
                                                        hàng</span></label><br>
                                                <input type="radio" id="html" name="fav_language" value="HTML"
                                                    style="height: 20px; width: 18%;">
                                                <label for="html"><img
                                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/2560px-Stripe_Logo%2C_revised_2016.svg.png"
                                                        width="50px;"></label><br>
                                                <input type="radio" id="html" name="fav_language" value="HTML"
                                                    style="height: 20px; width: 18%;">
                                                <label for="html"><img
                                                        src="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1458245625/pwegh6kadcb37kuz0woj.png"
                                                        width="25px;"></label><br>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div class="order-button-payment">
                                    <input value="Thanh toán" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Checkout Area End-->
@endsection
