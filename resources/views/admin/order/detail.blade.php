@extends('admin.main')

@section('content')
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12" style="text-align: center; margin-bottom: 50px;">
                <h2>
                    KIỂM TRA THÔNG TIN ĐƠN HÀNG
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <?php $sub = 0; ?>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-2 invoice-col">
                <address>
                    <strong>Tên khách hàng: </strong><br>
                    <strong>Số điện thoại: </strong><br>
                    <strong>Địa chỉ giao hàng: </strong><br>
                    <strong>Email khách hàng: </strong>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-7 invoice-col">

                <address>
                    {{ $order->user->name }}<br>
                    {{ $order->user->phone }}<br>
                    {{ $order->delivery_address }}<br>
                    {{ $order->user->email }}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
                <b>Đơn hàng: </b>#0000{{ $order->id }}<br>
                <b>Tổng đơn: </b>{{ number_format($order->total) }} <span style="text-decoration: underline;">đ</span><br>
                <b>Ngày đặt:</b> {{ $order->created_at->format('d/m/Y') }}<br>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row" style="margin-top: 30px;">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="bg-warning text-dark" style="text-align: center;">
                            <th width="10%" style="text-align: left;">#</th>
                            <th width="25%" style="text-align: left;">Sản phẩm</th>
                            <th width="25%">Hình ảnh</th>
                            <th width="15%">Số lượng</th>
                            <th width="25%">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $orderDetail)
                            <tr style="text-align: center;">
                                <td style="text-align: left;">1</td>
                                <td style="text-align: left;">{{ $orderDetail->product->name }}
                                    {{ $orderDetail->product->rom }} - {{ $orderDetail->product->color }}</td>
                                <td><img src="{{ $orderDetail->product->images->where('type', 'cover')->first()['url'] }}"
                                        width="100"></td>
                                <td>{{ $orderDetail->quantity }}</td>
                                <td style="color: red;">
                                    {{ number_format($orderDetail->product->discount > 0 ? $orderDetail->product->price - $orderDetail->product->discount : $orderDetail->product->price) }}
                                    <span style="text-decoration: underline;">đ</span>
                                </td>
                            </tr>
                            <?php
                            $sub += ($orderDetail->product->discount > 0 ? $orderDetail->product->price - $orderDetail->product->discount : $orderDetail->product->price) * $orderDetail->quantity;
                            ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-3">
                <p class="lead">Phương thức thanh toán:</p>
                <i class="fa fa-check-circle-o green"></i><span class="ms-1">
                    @if ($order->payment_id == 1)
                        <span class="badge bg-success" style="font-size: 18px;">Trả khi nhận hàng</span>
                    @elseif ($order->payment_id == 3)
                        <span class="badge bg-warning" style="font-size: 18px;"><img
                                src="https://images.careerbuilder.vn/employer_folders/lot9/221789/103316momopink-logo.png"
                                style="margin-right: 10px;" width="30px">Thanh toán Momo</span>
                    @elseif ($order->payment_id == 2)
                        <span class="badge bg-warning" style="font-size: 18px;"><img
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/2560px-Stripe_Logo%2C_revised_2016.svg.png"
                                style="margin-right: 10px;" width="50px">Thanh toán Stripe</span>
                    @endif
                </span>
            </div>
            <div class="col-3">
                <p class="lead">Trạng thái đơn hàng: </p>
                <div class="form-group">
                    <form method="post" id="form-status" style=" display:inline!important;"
                        action="/admin/order/update/{{ $order->id }}">
                        @csrf
                        <input name="_method" type="hidden" value="POST">
                        <select class="custom-select" name="status"
                        {{
                           ($order->status->id == 3 || $order->status->id == 4) ? 'disabled' : ''
                        }}>
                            @if ($order->status->id == 1)
                                <option value="1" {{ $order->status->id == 1 ? 'selected' : '' }}>Chờ xác nhận
                                </option>
                                <option value="2" {{ $order->status->id == 2 ? 'selected' : '' }}>Đã xác nhận
                                </option>
                                <option value="5" {{ $order->status->id == 5 ? 'selected' : '' }}>Hủy đơn hàng
                                </option>
                            @elseif ($order->status->id == 2)
                                <option value="2" {{ $order->status->id == 2 ? 'selected' : '' }}>Đã xác nhận
                                </option>
                                <option value="3" {{ $order->status->id == 3 ? 'selected' : '' }}>Đang giao hàng
                                </option>
                            @elseif ($order->status->id == 3)
                                <option value="3" {{ $order->status->id == 3 ? 'selected' : '' }}>Đang giao hàng
                                </option>
                            @elseif ($order->status->id == 4)
                                <option value="4" {{ $order->status->id == 4 ? 'selected' : '' }}>Giao thành công
                                </option>
                            @elseif ($order->status->id == 5)
                                <option value="5" {{ $order->status->id == 5 ? 'selected' : '' }}>Hủy đơn hàng
                                </option>
                            @endif
                        </select>
                    </form>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-6">

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Tạm tính:</th>
                            <td style="font-weight: bold;">{{ number_format($sub) }} <span
                                    style="text-decoration: underline;">đ</span></td>
                        </tr>
                        <tr>
                            <th>Mã giảm:</th>
                            <td style="font-weight: bold;">
                                @if ($discount != null)
                                    @if ($discount->type_discount == '%')
                                        {{ number_format($sub * ($discount->amount / 100)) }}
                                    @else
                                        {{ number_format($discount->amount) }}
                                    @endif
                                @else
                                    0
                                @endif
                                <span style="text-decoration: underline;">đ</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Vận chuyển:</th>
                            <td style="font-weight: bold;">30,000<span style="text-decoration: underline;">đ</span></td>
                        </tr>
                        <tr>
                            <th>Tổng thanh toán:</th>
                            <td style="color: red; font-weight: bold;">{{ number_format($order->total) }} <span
                                    style="text-decoration: underline;">đ</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-8">

                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <a href="/admin/order/generate-pdf/{{ $order->id }}" style="color: white;"> <i
                            class="fas fa-print"></i> Xuất PDF</a>
                </button>

                <button type="button" class="btn btn-info show-alert-change-status">Lưu thay đổi</button>

            </div>
        </div>
    </div>

    <script type="text/javascript">

        $('.show-alert-change-status').click(function(event) {
            var form = document.getElementById("form-status");
            var name = $(this).data("name");
            event.preventDefault();
             new swal({
                title: "Bạn có chắc lưu thay đổi?",
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
