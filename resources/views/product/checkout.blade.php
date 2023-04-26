@extends('index')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area" style="margin-top: -20px;">
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
            <form action="/products/checkout-product" id="form-discount" method="POST" onsubmit="return ValidationEvent()">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="checkbox-form">
                            <h3 style="color: #d0021c;">Thanh toán đơn hàng</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Họ và tên <span class="required">*</span></label>
                                        <input value="{{ $user->name }}" type="text" >
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ giao hàng <span class="required">*</span></label>
                                        @if (isset($addresses) && count($addresses) > 0)
                                            <select class="form-select" style="background-color: white;"
                                                aria-label="Default select example" name="delivery_address"  id="delivery_address">
                                                <option value="{{ $user->address}}"> {{ $user->address}}</option>
                                                @foreach ($addresses as $address)
                                                    <option value="{{ $address->address }}">{{ $address->address }}</option>
                                                @endforeach

                                            </select>
                                        @else
                                            <input placeholder="Địa chỉ giao hàng" name="delivery_address"
                                                type="text" id="delivery_address" value="{{ $user->address}}">
                                                <p id="delivery_address_alert" style="color:red;margin-top:15px; height: 10px;"></p>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email <span class="required">*</span></label>
                                        <input placeholder="Địa chỉ mail" style="background-color: #f2f2f2;"
                                            value="{{ $user->email }}" type="email" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại giao hàng <span class="required">*</span></label>
                                        @if (isset($user->phone))
                                            <input type="text" value="{{ $user->phone }}" name="phone_number"
                                                placeholder="Số điện thoại" id="phone_number">
                                            <p id="phone_number_alert" style="color:red;margin-top:5px;height: 20px;"></p>
                                        @else
                                            <input type="text" placeholder="Số điện thoại..." name="phone_number" id="phone_number" >
                                            <p id="phone_number_alert" style="color:red;margin-top:5px;height: 20px;"></p>
                                        @endif


                                    </div>
                                </div>
                            </div>
                              @if( $user->address !== null)
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
                                                <label>Địa chỉ giao hàng mới </label>
                                                <input placeholder="Địa chỉ giao hàng mới" name="new_address"
                                                    type="text" id="new_address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             @endif
                            <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Ghi chú giao hàng</label>
                                    <textarea id="checkout-mess" name="note" cols="30" rows="10"
                                        placeholder="Ghi chú thông tin như giao hàng nhanh, hàng dễ vỡ..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        @php $summary = 0; @endphp
                        <div class="your-order">
                            <h3 style="text-align: center;">Đơn hàng của bạn</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr style="text-align: left;">
                                            <th class="cart-product-name">Sản phẩm</th>
                                            <th class="cart-product-total">Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: left;">
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
                                                    <td class="cart-product-name"> {{ $product->name }}
                                                        @if($product->category_id !=4 )
                                                        {{ $product->rom}}
                                                        @endif
                                                        {{ $product->color}}<strong
                                                            class="product-quantity"> × {{ $carts[$product->id] }}</strong>
                                                    </td>
                                                    <td class="cart-product-total">
                                                        <span class="amount">
                                                            {{ number_format(($product->discount > 0 ? $product->price - $product->discount : $product->price) * $carts[$product->id]) }}
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
                                        <tr class="cart-subtotal" style="text-align: left;">
                                            <th>Giao hàng</th>
                                            <td><span class="amount">
                                                    @if (\Illuminate\Support\Facades\Session::get('carts'))
                                                        {{ number_format(30000) }}
                                                    @else
                                                        {{ 0 }}
                                                    @endif <span
                                                        style="text-decoration: underline;">đ</span>
                                                </span></td>

                                        </tr>

                                        <tr class="cart-subtotal">
                                            <th>Giảm giá</th>
                                            <td id="#show-discount"><span class="amount">
                                                    @if (Session::get('discount') && Session::get('discount')['type'] == 'money')
                                                        <span> - {{ number_format(Session::get('discount')['amount']) }} <span
                                                                style="text-decoration: underline;">đ</span></span>
                                                    @elseif(Session::get('discount') && Session::get('discount')['type'] == 'percent')
                                                        - {{ number_format($summary * (Session::get('discount')['amount'] / 100)) }}
                                                        <span style="text-decoration: underline;">đ</span>
                                                        ({{ Session::get('discount')['amount'] }} %)
                                                    @else
                                                        0 <span style="text-decoration: underline;">đ</span>
                                                    @endif
                                                </span></td>
                                            <input type="hidden" name="discount_summary"
                                                value="@if (Session::get('discount')) {{ number_format(Session::get('discount')['amount']) }}
                                                    @else
                                                        {{ 0 }} @endif">
                                        </tr>
                                        <tr class="order-total">
                                            <?php
                                               if (\Illuminate\Support\Facades\Session::get('carts'))  $ship = 30000;
                                               else $ship = 0;
                                            ?>
                                            <th>Tổng cộng</th>
                                            <td id="order-summary"><strong><span class="amount">
                                                        @if (Session::get('discount') && Session::get('discount')['type'] == 'money')
                                                            {{ number_format(($summary - Session::get('discount')['amount']) + $ship) }}
                                                        @elseif(Session::get('discount') && Session::get('discount')['type'] == 'percent')
                                                            {{ number_format(($summary - $summary * (Session::get('discount')['amount'] / 100)) + $ship) }}
                                                        @else
                                                            {{ number_format($summary + $ship ) }}
                                                        @endif
                                                    </span><span style="text-decoration: underline;">đ</span></strong></td>
                                            <input type="hidden"
                                                value=" @if (Session::get('discount') && Session::get('discount')['type'] == 'money') {{ ($summary - Session::get('discount')['amount']) + $ship }}
                                                        @elseif(Session::get('discount') && Session::get('discount')['type'] == 'percent')
                                                               {{ ($summary - $summary * (Session::get('discount')['amount'] / 100)) + $ship }}
                                                        @else
                                                            {{ $summary + $ship }} @endif"
                                                name="summary">

                                            @if (Session::get('discount'))
                                                <input type="hidden" value="{{ Session::get('discount')['code'] }}" name="code">
                                            @endif
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card" style="margin-bottom:40px; ">
                                            {{-- <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title">
                                                    <a class="" data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Mã giảm giá
                                                    </a>
                                                </h5>
                                            </div> --}}
                                            {{-- <div>
                                                <div class="card-body" style="margin-top: 20px;">
                                                    <div class="justify-content-center">
                                                        <div class="coupon-info">
                                                            <p class="checkout-coupon">
                                                                <input placeholder="Mã giảm giá" name="discount"
                                                                    type="text"
                                                                    style="margin-left: 50px;margin-right: 85px;">
                                                                <span id="submit-discount"
                                                                    style="background: #333 none repeat scroll 0 0;border: medium none;border-radius: 0;color: #fff;
                                                                 height: 36px;cursor: pointer;margin-left: 6px;padding: 10px 10px;-webkit-transition: all 0.3s ease 0s;transition: all 0.3s ease 0s;width: inherit;">Áp
                                                                    dụng mã</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="card" style="margin-top: -25px;">
                                            {{-- <div style="margin-bottom: 20px;">
                                                <h5 class="panel-title" style="margin-left: 30px;">
                                                    <a class="collapsed" data-toggle="collapse"
                                                        data-target="#collapseTwo" aria-expanded="false"
                                                        aria-controls="collapseTwo">
                                                        Phương thức thanh toán
                                                    </a>
                                                </h5>
                                            </div> --}}
                                            <div>
                                                <input type="radio" id="html" name="payment_method"
                                                    value="1" checked style="height: 20px; width: 18%;">
                                                <label for="html"> <span class="amount"
                                                        style="font-weight: bold;">Thanh toán khi nhận
                                                        hàng</span></label><br>
                                                <input type="radio" id="html" name="payment_method"
                                                    value="2" style="height: 20px; width: 18%;" id="vnpay">
                                                <label for="html"><img
                                                        src="https://i0.wp.com/discvietnam.com/wp-content/uploads/2020/07/C%E1%BB%95ng-thanh-to%C3%A1n-VNPAY-Logo-Th%E1%BA%BB-ATM-T%C3%A0i-kho%E1%BA%A3n-ng%C3%A2n-h%C3%A0ng-Online-Banking-M%C3%A3-QR-QR-Pay-Qu%C3%A9t-QR-Transparent.png?fit=360%2C140&ssl=1"
                                                        width="60px;"></label><br>
                                                <input type="radio" id="html" name="payment_method" value="3" style="height: 20px; width: 18%;" id="momo">
                                                <label for="html"><img
                                                        src="https://logos-world.net/wp-content/uploads/2020/07/PayPal-Logo.png"
                                                        width="60px;"></label><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <button type="submit">Thanh toán </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
    <!--Checkout Area End-->
<script>
    //validation event for form submit
    function ValidationEvent(event) {
    // Storing Field Values In Variables
      let check = true;
      var address = document.getElementById("delivery_address");
      var phone = document.getElementById("phone_number");

    if (address.value == "") {
        document.getElementById("delivery_address_alert").innerHTML = "Địa chỉ không được để trống";
        check = false;
    } else {
        document.getElementById("delivery_address_alert").innerHTML = "";
    }

    if (phone.value == "") {
        document.getElementById("phone_number_alert").innerHTML = "Số điện thoại không được để trống";
        check = false;
    } else {
        document.getElementById("phone_number_alert").innerHTML = "";
    }


    if (!validateNumber(phone.value)) {
        document.getElementById("phone_number_alert").innerHTML = "Số điện thoại không hợp lệ";
        check = false;
    } else {
        document.getElementById("phone_number_alert").innerHTML = "";
    }


     return check;
    }

    function validateNumber(e) {
    const pattern = /^\d{10,11}$/;

    return pattern.test(e)
    }

   </script>
<script>
    //ready function change action of form-discount based on checked of radio button with name payment_method

    $(document).ready(function() {
        $('input[type=radio][name=payment_method]').click(function() {
            if (this.value == 2) {
                $('#form-discount').attr('action', '/products/checkout-product/vnpay');
            } else if (this.value == 3) {
                $('#form-discount').attr('action', '/products/process-transaction');
            } else{
                $('#form-discount').attr('action', '/products/checkout-product');
            }
        });
    });

</script>


@endsection

