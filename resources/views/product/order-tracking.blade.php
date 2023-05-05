@extends('index')
@section('content')
<div class="container" style="margin-bottom: 30px;">
    <div class="btn-group" role="group" aria-label="Basic outlined example" style="margin-bottom: 20px">
        <a id="all-order" href="/users/order-tracking"
            class="btn btn-outline-secondary {{ $status == 0 || !isset($status) ? 'active' : ''}}">Tất cả</a>
        <a id="wait-for-confirm" href="/users/order-tracking?status=1"
            class="btn btn-outline-primary {{ $status == 1 ? 'active' : ''}}">Chờ xác nhận</a>
        <a id="confirmed" href="/users/order-tracking?status=2"
            class="btn btn-outline-info {{ $status == 2 ? 'active' : ''}}">Đã xác nhận</a>
        <a href="/users/order-tracking?status=3" class="btn btn-outline-warning {{ $status == 3 ? 'active' : ''}}">Đang
            giao hàng</a>
        <a href="/users/order-tracking?status=4" class="btn btn-outline-success {{ $status == 4 ? 'active' : ''}}">Giao
            hàng thành công</a>
        <a href="/users/order-tracking?status=5" class="btn btn-outline-danger {{ $status == 5 ? 'active' : ''}}">Đã
            hủy</a>
    </div>
    <div class="card">
        @if ($orders->count() == 0)
        <div class="text-center" style="margin-top: 50px;">
            <i class="fa fa-shopping-cart fa-5x" style="color: #666;" aria-hidden="true"></i>
        </div>
        <div class="text-center" style="margin-top: 20px;color: #666;">
            <h4>Chưa có đơn hàng</h4>
        </div>
        @endif
        @foreach ($orders as $order)

        <?php $sub = 0; ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 style="margin-bottom: 20px;">Đơn hàng: #{{ $order->id }}</h5>
                </div>
                <div class="col-md-6" style="text-align: right;">
                    @if ($order->status->id == 1)
                    <form method="get" id="form-cancel" style=" display:inline!important;"
                        action="/products/order/update-status/{{ $order->id }}">
                        @csrf
                        <input type="hidden" name="status" value="5">
                        <div class="cancel-order" style="padding: 0px 15px 25px 15px;">
                            <p class="btn btn-warning back-order" data-abc="true"> <i class="fa fa-times"></i>
                                Hủy
                                đặt hàng</p>
                        </div>
                    </form>
                    @elseif ($order->status->id == 5)
                    <div style="padding: 0px 15px 25px 15px;"><a style="color: white;"
                            class="btn btn-warning back-order" data-abc="true"> Đã hủy đơn hàng</a></div>
                    @elseif ($order->status->id == 3)
                    <form method="get" id="form-confirm" style=" display:inline!important;"
                        action="/products/order/update-status/{{ $order->id }}">
                        @csrf
                        <input type="hidden" name="status" value="4">
                        <div class="receive-order" style="padding: 0px 15px 25px 15px;">
                            <p class="btn btn-warning back-order" data-abc="true"> <i class="fa fa-check"></i>
                                Đã nhận hàng</p>
                        </div>
                    </form>

                    @elseif($order->status->id == 4 && $order->rating == null && $order->feedback == null)

                    <div style="padding: 0px 15px 25px 15px;">
                        <a class="btn btn-warning back-order" href="#" data-toggle="modal" data-target="#mymodal{{$order->id}}">Viết
                            đánh giá</a>
                    </div>
                    @endif

                </div>
            </div>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Ngày đặt hàng:</strong> <br>{{ $order->order_date }} </div>
                    <div class="col"> <strong>Số điện thoại giao hàng:</strong> <br> <i class="fa fa-phone"></i> {{
                        $user->phone }}</div>
                    <div class="col"> <strong>Trạng thái:</strong> <br> {{ $order->status->name }} </div>
                    <div class="col"> <strong>Địa chỉ giao hàng:</strong> <br> {{ $order->delivery_address }} </div>
                </div>
            </article>
            <div class="track">
                <div class="step {{ $order->status_id != 5 ? 'active' : '' }}"> <span class="icon"> <i
                            class="fa fa-check"></i> </span> <span class="text">Chờ xác nhận</span> </div>
                <div class="step {{ $order->status_id >= 2 && $order->status_id != 5 ? 'active' : '' }}"> <span
                        class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Đã xác
                        nhận</span> </div>
                <div class="step {{ $order->status_id >= 3 && $order->status_id != 5 ? 'active' : '' }}"> <span
                        class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Đang giao hàng
                    </span> </div>
                <div class="step {{ $order->status_id >= 4 && $order->status_id != 5 ? 'active' : '' }}"> <span
                        class="icon"> <i class="fa fa-archive"></i> </span> <span class="text">Giao hàng thành
                        công</span> </div>
            </div>
            <hr>
            <ul class="row">

                @foreach ($order->orderDetails as $orderDetail)
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img
                                src="{{ $orderDetail->product->images->where('type', 'cover')->first()['url'] }}"
                                width="150" class="img-sm border" style="padding: 15px;"></div>
                        <figcaption class="info align-self-center">
                            <p class="title" style="font-weight: bold;">{{ $orderDetail->product->name }}<br>
                                @if($orderDetail->product->ram != 'N/A' && $orderDetail->product->rom != 'N/A')
                                {{ $orderDetail->product->ram }} - {{ $orderDetail->product->rom }}
                                {{$orderDetail->product->color}}</p>
                            @endif

                            <span class="text-muted">{{ number_format($orderDetail->product->price) }}<span
                                    style="text-decoration: underline;">đ</span> x {{ $orderDetail->quantity }}
                            </span>
                        </figcaption>
                    </figure>
                </li>
                <?php
                                $sub += ($orderDetail->product->discount > 0 ? $orderDetail->product->price - $orderDetail->product->discount : $orderDetail->product->price) * $orderDetail->quantity;
                            ?>
                @endforeach
            </ul>
            <div class="row justify-content-end" style="margin: 20px 30px 10px 10px;">
                <div class="col-md-4">
                    @if($order->status_id == 2 || $order->status_id == 3 )
                    <p style="font-weight: bold;">Đã xác nhận: <span class="text" style="font-weight: normal;"> {{
                            $order->updated_at}}</span> </p>
                    @elseif($order->status_id == 4)
                    <p style="font-weight: bold;">Nhận hàng: <span class="text" style="font-weight: normal;"> {{
                            $order->updated_at}}</span>
                    </p>
                    @elseif($order->status_id == 5)
                    <p style="font-weight: bold;">Huỷ đơn hàng: <span class="text" style="font-weight: normal;"> {{
                            $order->updated_at}}</span> </p>
                    @endif
                    <p style="font-weight: bold;">Ghi chú: <span class="text" style="font-weight: normal;"> {{
                            $order->note}}</span> </p>

                </div>
                <div class="col-md-8" style="text-align: end;">
                    <h6>Tạm tính: {{ number_format($sub) }} <span style="text-decoration: underline;">đ</span></td>
                    </h6>
                    <h6>Mã giảm:
                        @if($order->voucher_id != null)
                        @if ($order->voucher->type_discount == "percent")
                        {{ number_format($sub * $order->voucher->amount/ 100) }} ({{ $order->voucher->amount }}%)
                        @else
                        {{ number_format($order->voucher->amount) }}
                        @endif
                        @else
                        0
                        @endif
                        <span style="text-decoration: underline;">đ</span>
                    </h6>
                    <h6>Giao hàng: 30,000 <span style="text-decoration: underline;">đ</span></h6>
                    <h5 style="color: red;">Tổng cộng: {{ number_format($order->total) }} <span
                            style="text-decoration: underline;">đ</span></h5>
                </div>
            </div>
            <hr style="margin: 15px 0px 0px 0px;">
        </div>
        <div class="modal fade modal-wrapper" id="mymodal{{$order->id}}">
            <div class="modal-dialog modal-dialog-centered" style="justify-content: center;" role="document">
                <div class="modal-content" style="width: 500px;" style="margin-left: 100px;">
                    <div class="modal-body">
                        <div class="li-review-content">
                            <!-- Begin Feedback Area -->
                            <div class="feedback-area" style="padding: 30px;">
                                <div class="feedback">
                                    <h3 class="feedback-title">Đánh giá đơn hàng #{{$order->id}}</h3>
                                    <form action="/products/feedback" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $order->id }}" name="order_id">
                                        <p class="your-opinion">
                                            <label>Mức độ hài lòng</label>
                                            <span>
                                                <select class="star-rating" name="rating">
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
                                            <textarea id="feedback" name="feedback" cols="45" rows="8"
                                                aria-required="true"></textarea>
                                        </p>
                                        <div class="feedback-input">

                                            <div class="feedback-btn pb-15 pt-20">
                                                <a href="#" class="close" data-dismiss="modal" aria-label="Close"
                                                    style="margin-top: 20px;">Đóng</a>
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

        @endforeach
        <div style="padding: 0px 15px 25px 15px;"><a href="/" class="btn btn-warning back-order" data-abc="true">
                <i class="fa fa-chevron-left"></i> Quay lại mua hàng</a></div>
    </div>
    <div class="row" style="margin: 20px 0px; color: black;">
        {!! $orders->links() !!}
    </div>


</div>

<script type="text/javascript">
    $('.cancel-order').click(function(event) {
            var form = document.getElementById("form-cancel");
            var name = $(this).data("name");
            event.preventDefault();
            new swal({
                title: "Bạn có chắc muốn hủy?",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Yes"]
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
</script>

<script type="text/javascript">
    $('.receive-order').click(function(event) {
            var form = document.getElementById("form-confirm");
            var name = $(this).data("name");
            event.preventDefault();
            new swal({
                title: "Bạn đã nhận được hàng?",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Yes"]
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
</script>

<script>
    //Get current path to active location
            var path = window.location.href;
            if (path.includes("/admin/order/")) {
                document.getElementById("sidebar-order").classList.add("active");
            }
            if (path.includes("/admin/product")) {
                document.getElementById("sidebar-product").classList.add("active");
            }



</script>
@endsection
