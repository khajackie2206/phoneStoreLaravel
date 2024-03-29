@extends('admin.main')

@section('content')
<main class="content">
    <div class="container-fluid">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Lịch sử hệ thống</h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body h-100">
                        <div class="container ">
                            <div class="table-responsive">
                                <table class="table table-responsive table-borderless table-striped" id="activity-table"
                                    style="padding-top:20px;">
                                    <thead>
                                        <tr class="bg-warning text-dark">
                                            <th scope="col" width="7%">ID</th>
                                            <th scope="col" width="10%" style="text-align: left;">Avatar
                                            </th>
                                            <th scope="col" width="20%" style="text-align: left;">Tài khoản</th>

                                            <th scope="col" width="38%" style="text-align: left;">Hành động</th>
                                            <th scope="col" width="25%" style="text-align: left;">Thời gian</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: left;"></tbody>
                                    {{-- <tbody>
                                        @foreach ($orders as $order)
                                        <tr style="text-align: center;">
                                            <td>{{ $order->id }}</td>
                                            <td style="font-weight: bold;">{{ $order->user->name }}</td>
                                            <td style="color:red;font-weight: bold;">{{ number_format($order->total) }}
                                                <span style="text-decoration: underline;">đ</span>
                                            </td>
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
                                            <td style="font-weight: bold;"> <span> {{$order->created_at}} </span></td>
                                            <td style="text-align: left;"> <a
                                                    style="margin-left:20px; margin-right: 7px;"
                                                    href="/admin/order/detail/{{$order->id}}">
                                                    <i class="fas fa-edit fa-xl"></i>
                                                </a>
                                                @if ($order->status->id == 1 || $order->status->id == 5)
                                                <form method="post" style=" display:inline!important;"
                                                    action="/admin/order/delete/{{ $order->id }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="post">
                                                    <i type="submit" style="color: red;"
                                                        class="fas fa-trash fa-xl show-alert-delete-box"></i>
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

{{-- <script type="text/javascript">
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
</script> --}}
<script>
    $(document).ready(function() {
             $('#activity-table').DataTable({
                 processing: true,
                 serverSide: true,
                 order: [[ 4, 'desc' ]],
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
                 ajax: '{!! route('activity_data') !!}',
                 columns: [{
                         data: 'id',
                     },
                        {
                            data: 'avatar',

                        },
                      {
                         data: 'admin.email',

                      },
                     {
                         data: 'action',

                     },
                     {
                         data: 'created_at',
                     },
                 ],
             });
         });
</script>
{{-- <script>
    function deleteOrder(ev) {
             var urlToRedirect = ev.currentTarget.getAttribute('href');
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn xóa đơn hàng này không?",
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
</script> --}}
@endsection
