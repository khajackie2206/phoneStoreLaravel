@extends('index')
@section('content')
    <div class="container" style="margin-bottom: 30px;">

            <div class="card">
                 @foreach ($orders->get() as $order)
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <h5 style="margin-bottom: 20px;">Đơn hàng: #{{ $order->id }}</h5>
                        </div>
                         <div class="col-md-6" style="text-align: right;">
                        <div style="padding: 0px 15px 25px 15px;"><a href="#" class="btn btn-warning back-order" data-abc="true"> <i
                            class="fa fa-times"></i> Hủy đặt hàng</a></div>
                        </div>
                </div>

                    <article class="card">
                        <div class="card-body row">
                            <div class="col"> <strong>Ngày đặt hàng:</strong> <br>{{ $order->order_date }} </div>
                            <div class="col"> <strong>Số điện thoại giao hàng:</strong> <br> <i
                                    class="fa fa-phone"></i> {{ $user->phone }}</div>
                            <div class="col"> <strong>Trạng thái:</strong> <br> {{ $order->status->name }} </div>
                            <div class="col"> <strong>Theo dõi #:</strong> <br> A0000{{ $order->id }} </div>
                        </div>
                    </article>
                    <div class="track">
                        <div class="step {{ $order->status_id != 5 ? 'active' : '' }}"> <span class="icon"> <i
                                    class="fa fa-check"></i> </span> <span class="text">Chờ duyệt</span> </div>
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
                       @foreach($order->orderDetails as $orderDetail)
                        <li class="col-md-4">
                            <figure class="itemside mb-3">
                                <div class="aside"><img src="{{$orderDetail->product->images->where('type', 'cover')->first()['url']}}" width="150" class="img-sm border" style="padding: 15px;"></div>
                                <figcaption class="info align-self-center">
                                    <p class="title" style="font-weight: bold;">{{ $orderDetail->product->name }}<br> {{ $orderDetail->product->rom}} - {{$orderDetail->product->ram}}GB RAM</p>
                                     <span class="text-muted" >{{ number_format($orderDetail->product->price) }}<span style="text-decoration: underline;">đ</span> x {{$orderDetail->quantity}}
                                    </span>
                                </figcaption>
                            </figure>
                        </li>
                        @endforeach
                    </ul>
                    <div class="row justify-content-end" style="margin: 20px 30px 10px 10px;">
                        <h5 style="color: red;">Tổng cộng: {{ number_format($order->total) }} <span
                                style="text-decoration: underline;">đ</span></h4>
                    </div>
                    <hr style="margin: 15px 0px 0px 0px;">
                </div>
                  @endforeach
                <div style="padding: 0px 15px 25px 15px;"><a href="#" class="btn btn-warning back-order" data-abc="true"> <i
                            class="fa fa-chevron-left"></i> Quay lại mua hàng</a></div>
            </div>

    </div>
@endsection
