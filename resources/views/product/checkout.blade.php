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
            <form action="/products/checkout-product" id="form-discount" method="post">
                <input name="_method" type="hidden" value="post">
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
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ giao hàng <span class="required">*</span></label>
                                        @if (isset($addresses) && count($addresses) > 0)
                                            <select class="form-select" style="background-color: white;"
                                                aria-label="Default select example" name="delivery_address"  id="delivery_address">
                                                @foreach ($addresses as $address)
                                                    <option value="{{ $address->address }}">{{ $address->address }}</option>
                                                @endforeach

                                            </select>
                                        @else
                                            <input placeholder="Địa chỉ giao hàng" name="delivery_address"
                                                type="text" id="delivery_address" value="{{ $user->address}}" onchange="saveValue(this);">
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
                                                placeholder="Số điện thoại" style="background-color: #f2f2f2;" id="phone_number"  disabled>
                                        @else
                                            <input type="text" placeholder="Số điện thoại" name="phone_number" id="phone_number" onchange="saveValue(this);">
                                        @endif

                                    </div>
                                </div>
                            </div>
                            {{-- @if (isset($addresses) && count($addresses) > 0)
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
                                                    type="text" id="new_address" onchange="saveValue(this);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}
                            <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Ghi chú giao hàng</label>
                                    <textarea id="checkout-mess" name="note" cols="30" rows="10"
                                        placeholder="Ghi chú thông tin như giao hàng nhanh, hàng dễ vỡ..." onchange="saveValue(this);"></textarea>
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
                                                    <td class="cart-product-name"> {{ $product->name }}<strong
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
                                                    @if (Session::get('amount') && Session::get('type_discount') == 'money')
                                                        <span> {{ number_format(Session::get('amount')) }} <span
                                                                style="text-decoration: underline;">đ</span></span>
                                                    @elseif(Session::get('amount') && Session::get('type_discount') == 'percent')
                                                        {{ number_format($summary * (Session::get('amount') / 100)) }}
                                                        <span style="text-decoration: underline;">đ</span>
                                                        ({{ Session::get('amount') }} %)
                                                    @else
                                                        0 <span style="text-decoration: underline;">đ</span>
                                                    @endif
                                                </span></td>
                                            <input type="hidden" name="discount_summary"
                                                value="@if (Session::get('amount')) {{ number_format(Session::get('amount')) }}
                                                    @else
                                                        {{ 0 }} @endif">
                                        </tr>
                                        <tr class="order-total">
                                            <?php
                                            if (\Illuminate\Support\Facades\Session::get('carts')) {
                                                $summary += 30000;
                                            }
                                            ?>
                                            <th>Tổng cộng</th>
                                            <td id="order-summary"><strong><span class="amount">
                                                        @if (Session::get('amount') && Session::get('type_discount') == 'money')
                                                            {{ number_format($summary - Session::get('amount')) }}
                                                        @elseif(Session::get('amount') && Session::get('type_discount') == 'percent')
                                                            {{ number_format($summary - $summary * (Session::get('amount') / 100)) }}
                                                        @else
                                                            {{ number_format($summary) }}
                                                        @endif
                                                    </span><span style="text-decoration: underline;">đ</span></strong></td>
                                            <input type="hidden"
                                                value=" @if (Session::get('amount') && Session::get('type_discount') == 'money') {{ $summary - Session::get('amount') }}
                                                        @elseif(Session::get('amount') && Session::get('type_discount') == 'percent')
                                                               {{ $summary - $summary * (Session::get('amount') / 100) }}
                                                        @else
                                                            {{ $summary }} @endif"
                                                name="summary">

                                            @if (Session::get('code'))
                                                <input type="hidden" value="{{ Session::get('code') }}" name="code">
                                            @endif
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method" style="margin-top: 20px;">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card" style="margin-bottom:40px; ">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title">
                                                    <a class="" data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Mã giảm giá
                                                    </a>
                                                </h5>
                                            </div>
                                            <div>
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
                                            </div>
                                        </div>
                                        <div class="card" style="margin-top: 15px;">
                                            <div>
                                                <h5 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse"
                                                        data-target="#collapseTwo" aria-expanded="false"
                                                        aria-controls="collapseTwo">
                                                        Phương thức thanh toán
                                                    </a>
                                                </h5>
                                            </div>
                                            <div>
                                                <input type="radio" id="html" name="payment_method"
                                                    value="1" checked style="height: 20px; width: 18%;">
                                                <label for="html"> <span class="amount"
                                                        style="font-weight: bold;">Thanh toán khi nhận
                                                        hàng</span></label><br>
                                                <input type="radio" id="html" name="payment_method"
                                                    value="2" style="height: 20px; width: 18%;" id="vnpay">
                                                <label for="html"><img
                                                        src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBd2w2SHc9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--3c10eafdffd111f6ec8ef44d76353152683cf2b2/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--492f60b9aac6e8159e50e72bb289c5feb47a79d4/logo%20VNPAY-02.png"
                                                        width="50px;"></label><br>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="order-button-payment">
                                        <input value="Thanh toán" type="submit" name="redirect">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
    <!--Checkout Area End-->
    <script type="text/javascript">
        var shipbox = document.getElementById('ship-box');
         document.getElementById("phone_number").value = getSavedValue("phone_number");    // set the value to this input
         document.getElementById("checkout-mess").value = getSavedValue("checkout-mess");
        //  document.getElementById("delivery_address").value = getSavedValue("delivery_address");
        //  if(shipbox){
        //    $('#ship-box-info').slideToggle(1000);
        //   document.getElementById("new_address").value = getSavedValue("new_address");
        //   document.getElementById("ship-box").checked = true;
        //    }  // set the value to this input
        /* Here you can add more inputs to set value. if it's saved */

        //Save the value function - save it to localStorage as (ID, VALUE)
        function saveValue(e){
            var id = e.id;  // get the sender's id to save it .
            var val = e.value; // get the value.
            localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override .
        }

        //get the saved value function - return the value of "v" from localStorage.
        function getSavedValue (v){
            if (!localStorage.getItem(v)) {
                return "";// You can change this to your defualt value.
            }
            return localStorage.getItem(v);
        }
</script>
<script>
    //ready function change action of form-discount based on checked of radio button with name payment_method

    $(document).ready(function() {
        $('input[type=radio][name=payment_method]').change(function() {
            if (this.value == '2') {
                $('#form-discount').attr('action', '/products/checkout-product/vnpay');
            } else if (this.value == '1') {
                $('#form-discount').attr('action', '/products/checkout-product');
            }
        });
    });

</script>
@endsection

