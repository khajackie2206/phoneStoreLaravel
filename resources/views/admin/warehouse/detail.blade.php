@extends('admin.main')
@section('content')

<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12" style="text-align: center; margin-bottom: 50px;">
            <h2 class="mt-2" style="font-weight: 700">
                KIỂM TRA THÔNG TIN PHIẾU NHẬP
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <?php $sub = 0;
          $sumQuantity = 0;
    ?>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-3"><b>Người lập phiếu: <span style="color: red;">*</span></b></div>
                        <div class="col-9  p-2 rounded" style="background-color: rgb(237, 249, 255)">{{
                            $warehouse->admin->name}}</div>
                    </div>
                    <div class="row row d-flex align-items-center mb-3">
                        <div class="col-3"><b>Nhà cung cấp: <span style="color: red;">*</span></b></div>
                        <div class="col-9  p-2 rounded" style="background-color: rgb(237, 249, 255)">{{
                            $warehouse->supplier->name }}</div>
                    </div>
                    <div class="row row d-flex align-items-center mb-3">
                        <div class="col-3"><b>Ghi chú: <span style="color: red;">*</span></b></div>
                        <div class="col-9  p-2 rounded" style="background-color: rgb(237, 249, 255)">{{
                            $warehouse->note }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row row d-flex align-items-center mb-3">
                        <div class="col-3"><b>Ngày lập phiếu: <span style="color: red;">*</span></b></div>
                        <div class="col-9  p-2 rounded" style="background-color: rgb(237, 249, 255)">{{
                            $warehouse->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                    <div class="row row d-flex align-items-center mb-3">
                        <div class="col-3"><b>Trạng thái: <span style="color: red;">*</span></b></div>
                        <div class="col-9  p-2 rounded" style="background-color: rgb(237, 249, 255)">
                            @if($warehouse->status == 1)
                            Đã nhập kho
                            @elseif($warehouse->status == 2)
                            Bị từ chối
                            @else
                            Chờ xác nhận
                            @endif </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row" style="margin-top: 30px; margin-bottom: 50px">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="bg-warning text-dark" style="text-align: center;">
                        <th width="10%" style="text-align: left;">#</th>
                        <th width="25%" style="text-align: left;">Sản phẩm</th>
                        <th width="25%">Hình ảnh</th>
                        <th width="15%">Số lượng</th>
                        <th width="25%">Giá nhập</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($warehouse->warehouseDetails as $detail)
                    <tr style="text-align: center;">
                        <td style="text-align: left;"> {{ $i }}</td>
                        <td style="text-align: left;">{{ $detail->product->name }}
                            {{ $detail->product->rom }} - {{ $detail->product->color }}</td>
                        <td><img src="{{ $detail->product->images->where('type', 'cover')->first()['url'] }}"
                                width="100"></td>
                        <td>{{ $detail->quantity }}</td>
                        <td style="color: red;">
                            {{ number_format($detail->price) }}
                            <span style="text-decoration: underline;">đ</span>
                        </td>
                    </tr>
                    <?php
                            $i++;
                            $sub += $detail->price;
                            $sumQuantity += $detail->quantity;
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
        {{-- <div class="col-3">
            <p class="lead">Phương thức thanh toán:</p>
            <i class="fa fa-check-circle-o green" style="margin-left: -7px;"></i><span class="ms-1">
                @if ($order->payment_id == 1)
                <span class="badge bg-success" style="font-size: 16px;">Trả khi nhận hàng</span>
                @elseif ($order->payment_id == 3)
                <span class="badge bg-warning" style="font-size: 16px;"><img
                        src="https://logos-world.net/wp-content/uploads/2020/07/PayPal-Logo.png"
                        style="margin-right: 10px;" width="50px">Thanh toán Paypal</span>
                @elseif ($order->payment_id == 2)
                <span class="badge bg-warning" style="font-size: 16px; padding: 10px;"><img
                        src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR.png"
                        style="margin-right: 10px;" width="50px">Thanh toán VNPay</span>
                @endif
            </span>
        </div> --}}
        {{-- <div class="col-3">
            <p class="lead">Trạng thái đơn hàng: </p>
            <div class="form-group">
                <form method="post" id="form-status" style=" display:inline!important;"
                    action="/admin/order/update/{{ $order->id }}">
                    @csrf
                    <input name="_method" type="hidden" value="POST">
                    <select class="custom-select" name="status" {{ ($order->status->id == 4) ? 'disabled' : ''
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
        </div> --}}
        <!-- /.col -->
        <div class="col-6">


        </div>
        <div class="col-6">

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Tổng số lượng:</th>
                        <td style="font-weight: bold;">{{ $sumQuantity }}</td>
                    </tr>
                    <tr>
                        <th>Tổng cộng:</th>
                        <td style="color: red; font-weight: bold;">{{ number_format($warehouse->total) }} <span
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
        <div class="col-9 ">

            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                <a href="/admin/warehouses/export-pdf/{{ $warehouse->id }}" style="color: white;"> <i
                        class="fas fa-print"></i>
                    Xuất PDF</a>
            </button>

            @if ($warehouse->status != 1 && $user->role == 1)
            <a href="/admin/warehouses/change-status/{{ $warehouse->id }}?status=1" type="button"
                class="btn btn-info" onclick="return confirmWarehouse(event);">Duyệt phiếu nhập</a>
            @endif
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmWarehouse(ev) {
    var urlToRedirect = ev.currentTarget.getAttribute('href');
    event.preventDefault();
    swal({
    title: "Bạn có chắc muốn xác nhận?",
    icon: "warning",
    type: "warning",
    buttons: ["Cancel", "Yes!"],
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Đã kích hoạt!'
    }).then((willDelete) => {
    if (willDelete) {
    window.location.href = urlToRedirect;
    }
    });
    }
</script>
@endsection
