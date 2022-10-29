@extends('admin.main')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Danh sách đơn hàng</h1>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body h-100">
                            <div class="container ">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div class="position-relative" style="margin-bottom: 20px;">
                                        <span class="position-absolute" style="top: 6px; left: 10px;"><i
                                                class="fa fa-search"></i></span>
                                        <input class="form-control w-100" style="text-indent: 17px;"
                                            placeholder="Tìm kiếm theo tên, mã sản phẩm...">
                                    </div>


                                </div>
                                <div class="table-responsive">
                                    <table class="table table-responsive table-borderless">

                                        <thead>
                                            <tr class="bg-warning text-dark" style="text-align: center;">
                                                <th scope="col" width="5%">ID</th>
                                                <th scope="col" width="20%">Tên khách hàng</th>
                                                <th scope="col" width="15%">Tổng đơn</th>

                                                <th scope="col" width="10%">Trạng thái</th>
                                                <th scope="col" width="15%">Thanh Toán</th>
                                                <th scope="col" width="20%">Ngày đặt hàng</th>
                                                <th scope="col" width="15%"><span>Thao tác</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr style="text-align: center;">
                                                    <td>{{ $order->id }}</td>
                                                    <td style="font-weight: bold;">{{ $order->user->name }}</td>
                                                    <td style="color:red;">{{ number_format($order->total) }} <span style="text-decoration: underline;">đ</span></td>
                                                    <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                            @if ($order->status->id == 1)
                                                                <span class="badge bg-secondary">Chờ duyệt</span>
                                                            @elseif ($order->status->id == 2)
                                                                <span class="badge bg-success">Đã duyệt</span>
                                                            @elseif ($order->status->id == 3)
                                                                <span class="badge bg-warning">Đang giao hàng</span>
                                                            @elseif ($order->status->id == 4)
                                                                <span class="badge bg-info text-dark">Giao hàng thành công</span>
                                                            @elseif ($order->status->id == 5)
                                                                <span class="badge bg-danger">Đã hủy</span>
                                                            @endif
                                                        </span></td>
                                                    <td>
                                                        <i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                            @if ($order->payment_id == 1)
                                                                <span class="badge bg-success">Trả khi nhận hàng</span>
                                                            @elseif ($order->payment_id == 2)
                                                                <span class="badge bg-warning">Thanh toán Momo</span>
                                                            @elseif ($order->payment_id == 3)
                                                                <span class="badge bg-warning">Thanh toán Stripe</span>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td  style="font-weight: bold;"> <span> {{$order->created_at}} </span></td>
                                                    <td> <a
                                                            href="/admin/order/detail/{{$order->id}}">
                                                            <i class="fas fa-edit fa-xl"></i>
                                                        </a>

                                                        <form method="delete" style=" display:inline!important;"
                                                            action="/admin/product/delete/{{ $order->id }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                        <i type="submit" style="color: red;" class="fas fa-trash fa-xl show-alert-delete-box"></i>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             {{ $orders->links() }}
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Bạn có chắc muốn xóa sản phẩm này không?",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đã xóa!'
            }).then((willDelete) => {
                if (willDelete) {
                    swal({
                         title: 'Thành công!',
                         icon: 'success',
                         text: 'Đã xóa sản phẩm!',
                         type: 'success'
                     }).then(function() {
                         form.submit();
                     });
                }
            });
        });
    </script>
@endsection
