@extends('index')
@section('content')
    <div class="container" style="margin-bottom: 30px;">

        <div class="card">
            @if ($orders->isEmpty())
                <div class="text-center" style="margin-top: 50px;">
                    <i class="fa fa-shopping-cart fa-5x" style="color: #666;" aria-hidden="true"></i>
                </div>
                <div class="text-center" style="margin-top: 20px;color: #666;">
                    <h4>Bạn chưa mua sản phẩm nào</h4>
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
                            @endif
                        </div>
                    </div>

                    <article class="card">
                        <div class="card-body row">
                            <div class="col"> <strong>Ngày đặt hàng:</strong> <br>{{ $order->order_date }} </div>
                            <div class="col"> <strong>Số điện thoại giao hàng:</strong> <br> <i
                                    class="fa fa-phone"></i> {{ $user->phone }}</div>
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
                                            {{ $orderDetail->product->rom }} - {{ $orderDetail->product->ram }}GB RAM</p>
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
                            <p style="font-weight: bold;">Nhận hàng: <span class="text" style="font-weight: normal;"> {{ $order->updated_at}}</span>
                            </p>
                            @elseif($order->status_id == 5)
                            <p style="font-weight: bold;">Huỷ đơn hàng: <span class="text" style="font-weight: normal;"> {{
                                    $order->updated_at}}</span> </p>
                            @endif
                            <p style="font-weight: bold;">Ghi chú: <span class="text" style="font-weight: normal;"> {{ $order->note}}</span> </p>

                        </div>
                        <div class="col-md-8" style="text-align: end;">
                        <h6>Tạm tính: {{ number_format($sub) }} <span style="text-decoration: underline;">đ</span></td></h6>
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
@endsection
