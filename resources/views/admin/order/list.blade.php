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
                                <div class="btn-group" role="group" aria-label="Basic outlined example" style="margin-bottom: 20px;">
                                    <a href="/admin/order/export-csv"><button type="button" class="btn btn-outline-info">Xuất CSV</button></a>
                                    <a href="/admin/order/export-excel"><button type="button" class="btn btn-outline-info">Xuất Excel</button></a>
                                    <a href="/admin/order/generate-order-pdf"><button type="button" class="btn btn-outline-info">Xuất PDF</button></a>
                                </div>
                                <div class="table-responsive">

                                    <table class="table table-responsive table-borderless table-striped" id="order-table" style="padding-top:20px;" >

                                        <thead>
                                            <tr class="bg-warning text-dark">
                                                <th scope="col" width="7%">ID</th>
                                                <th scope="col" width="14%" style="text-align: left;">Tên khách hàng</th>
                                                <th scope="col" width="12%" style="text-align: left;">Tổng đơn</th>

                                                <th scope="col" width="15%"  style="text-align: left;">Trạng thái</th>
                                                <th scope="col" width="13%"  style="text-align: left;">Thanh toán</th>
                                                <th scope="col" width="14%"  style="text-align: left;">Duyệt đơn</th>
                                                <th scope="col" width="14%"  style="text-align: left;">Ngày đặt hàng</th>
                                                <th scope="col" width="12%"><span>Thao tác</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: left;"></tbody>
                                        {{-- <tbody>
                                            @foreach ($orders as $order)
                                                <tr style="text-align: center;">
                                                    <td>{{ $order->id }}</td>
                                                    <td style="font-weight: bold;">{{ $order->user->name }}</td>
                                                    <td style="color:red;font-weight: bold;">{{ number_format($order->total) }} <span style="text-decoration: underline;">đ</span></td>
                                                    <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                            @if ($order->status->id == 1)
                                                                <span class="badge bg-secondary">Chờ xác nhận</span>
                                                            @elseif ($order->status->id == 2)
                                                                <span class="badge bg-success">Đã xác nhận</span>
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
                                                            @elseif ($order->payment_id == 3)
                                                                <span class="badge bg-warning">Thanh toán Momo</span>
                                                            @elseif ($order->payment_id == 2)
                                                                <span class="badge bg-danger">Thanh toán Stripe</span>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td  style="font-weight: bold;"> <span> {{$order->created_at}} </span></td>
                                                    <td style="text-align: left;"> <a style="margin-left:20px; margin-right: 7px;"
                                                            href="/admin/order/detail/{{$order->id}}">
                                                            <i class="fas fa-edit fa-xl"></i>
                                                        </a>
                                                       @if ($order->status->id == 1 || $order->status->id == 5)
                                                        <form method="post" style=" display:inline!important;"
                                                            action="/admin/order/delete/{{ $order->id }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="post">
                                                          <i type="submit" style="color: red;" class="fas fa-trash fa-xl show-alert-delete-box"></i>
                                                        </form>
                                                       @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody> --}}
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             {{-- {{ $orders->links('custom') }} --}}
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Bạn có chắc muốn xóa đơn hàng này không?",
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
                         text: 'Đã xóa đơn hàng!',
                         type: 'success'
                     }).then(function() {
                         form.submit();
                     });
                }
            });
        });
    </script>
     <script>
         $(document).ready(function() {
             $('#order-table').DataTable({
                 processing: true,
                 serverSide: true,
                 order: [[ 6, 'desc' ]],
                 "language": {
                     "lengthMenu": "Hiển thị _MENU_ dòng mỗi trang",
                      "zeroRecords": "Không tìm thấy kết quả",
                      "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ kết quả",
                      "infoEmpty": "Hiển thị 0 tới 0 của 0 kết quả",
                      "infoFiltered": "(Lọc từ _MAX_ kết quả)",
                      "search": "Tìm kiếm:",
                      "paginate": {
                         "first": "Đầu tiên",
                          "last": "Cuối cùng",
                          "next": "Sau",
                         "previous": "Trước"
                    },
                 },
                 ajax: '{!! route('order_data') !!}',
                 columns: [{
                         data: 'id',

                     },
                     {
                         data: 'user.name',

                     },
                     {
                         data: 'total',

                     },
                     {
                         data: 'status_id',
                         "render": function(data, type, row, meta) {
                            if (data == 1) {
                                return `<i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                            <span class="badge bg-secondary">Chờ xác nhận</span>`
                            } else if(data == 2){
                                return `<i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                            <span class="badge bg-success">Đã xác nhận</span>`
                            } else if(data == 3){
                                return `<i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                           <span class="badge bg-warning">Đang giao hàng</span>`
                            } else if(data == 4){
                                return `<i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                           <span class="badge bg-info text-dark">Giao hàng thành công</span>`
                            } else {
                                return `<i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                           <span class="badge bg-danger">Đã hủy</span>`
                            }
                        }
                     },
                    { data: 'payment_id',
                        "render": function(data, type, row, meta) {
                            if (row["payment_id"] === 1) {
                                return `<span class="badge bg-success">Trả khi nhận hàng</span>`
                            } else if(row["payment_id"] === 3){
                                return ` <span class="badge bg-warning">Thanh toán Paypal</span>`
                            } else {
                                return `<span class="badge bg-danger">Thanh toán VNPay</span>`
                            }
                        }
                    },

                    {
                        data: 'admin',
                        // "render": function(data, type, row, meta) {
                        //   if (data.name == "Admin") {
                        //      return `<span style="font-weight:bold;"></span>`
                        //     } else if(!data){
                        //       return `<span style="font-weight:bold;"> *Chưa duyệt*</span>`
                        //    } else {
                        //      return `<span style="font-weight:bold;"></span>`
                        //   }
                        // }
                    },
                     {
                         data: 'created_at',

                     },
                     {
                         data: 'action',

                     },
                 ],

             });
         });
     </script>
      <script>
         function deleteOrder(ev) {
             var urlToRedirect = ev.currentTarget.getAttribute('href');
             event.preventDefault();
             new swal({
                 title: "Bạn có chắc muốn xóa đơn hàng này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
             }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = urlToRedirect;
                }
            });
         }
     </script>
@endsection
