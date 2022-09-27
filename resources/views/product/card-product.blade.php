@extends('index')
@section('content')
            <!-- Header Area End Here -->
            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Shopping Cart</li>
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
                            <form action="#">
                                @php $summary = 0; @endphp
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-remove" style="width: 100px;">Thao tác</th>
                                                <th class="li-product-thumbnail">Hình ảnh</th>
                                                <th class="cart-product-name" >Tên sản phẩm</th>
                                                <th class="cart-product-name" style="width: 140px;">Màu sắc</th>
                                                <th class="li-product-price">Giá</th>
                                                <th class="li-product-quantity">Số lượng</th>
                                                <th class="li-product-subtotal">Tổng cộng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       @if (\Illuminate\Support\Facades\Session::get('carts'))
                                        @foreach ($products as $product)
                                          
                                           @foreach ($carts[$product->id] as $item)
                                          
                                           @php
                                             $subTotal = $product->price * $item['quantity'];
                                             $summary += $subTotal;
                                         @endphp
                                            <tr>
                                                <td class="li-product-remove" style="width: 100px;"><a href="/products/delete-cart/{{$product->id}}?color={{$item['color']}}"><i class="fa fa-times"></i></a></td>
                                                <td class="li-product-thumbnail"><a href="#"><img src="{{ $product->images->where('type', 'cover')->first()['url'] }}" style = "width: 100px;"alt="Li's Product Image"></a></td>

                                                <td class="li-product-name"><a href="#">{{$product->name }}</a></td>
                                                <td class="li-product-name" style="width: 140px;" name="color{{$item['color']}}"><a href="#"> {{ $product->colors->where('id', $item['color'])->first()['name']}}</a></td>
                                                <td class="li-product-price"><span class="amount" style="color: red;">{{ number_format($product->price)}} <span style="text-decoration: underline;">đ</span></span></td>
                                                <td class="quantity">
                                                    
                                                    <label>Số lượng</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" id = "product-card-quantity" name="product-card-quantity" value={{$item['quantity'] }} type="text">
                                                        <div class="dec qtybutton rise-up" id="rise-up-card" name = "/products/rise-up/{{$product->id}}?color={{$item['color']}}"><i class="fa fa-angle-down"></i></div>
                                                        <div class="inc qtybutton go-down"><i class="fa fa-angle-up"></i></div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span class="amount" style="color: red;">{{ number_format($subTotal) }} <span style="text-decoration: underline;">đ</span></span></td>
                                            </tr>
                                              @endforeach
                                                    
                                           @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <div class="coupon">
                                                <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Mã giảm giá" type="text">
                                                <input class="button" name="apply_coupon" value="Áp dụng mã" type="submit">
                                            </div>
                                            <div class="coupon2">
                                                <input class="button" name="update_cart" value="Cập nhật giỏ hàng" type="submit" formaction="/products/update-cart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total">
                                            <h2>Tổng cộng giỏ hàng</h2>
                                            <ul>
                                                <li>Tạm tính <span>{{ number_format($summary)}} <span style="text-decoration: underline;">đ</span></span></li>
                                                <li>Tổng cộng<span>{{ number_format($summary)}} <span style="text-decoration: underline;">đ</span></span></li>
                                            </ul>
                                            <a href="#">Đi đến thanh toán</a>
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