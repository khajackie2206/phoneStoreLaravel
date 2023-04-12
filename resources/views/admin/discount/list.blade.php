 @extends('admin.main')
 @section('content')
     <main class="content">
         <div class="container-fluid">

             <div class="mb-3">
                 <h1 class="h3 d-inline align-middle">Danh sách giảm giá</h1>
                 <a class="badge bg-info text-white ms-2" href="/admin/discount/add">
                     Thêm +
                 </a>
             </div>
             <div class="row">
                 <div class="col-md-12 col-xl-12">
                     <div class="card">
                         <div class="card-body h-100">
                             <div class="container ">
                                 <div class="table-responsive">
                                     <table  id="discount-table" class="table table-responsive table-borderless table-striped" style="padding-top:20px;">

                                         <thead>
                                             <tr class="bg-warning text-dark" style="text-align: center;margin-top: 15px;">
                                                 <th scope="col" width="5%">#</th>
                                                 <th scope="col" width="12%">Mã giảm giá</th>
                                                 <th scope="col" width="10%">Số lượng</th>
                                                 <th scope="col" width="23%">Loại giảm giá</th>
                                                 <th scope="col" width="20%">Giá trị</th>
                                                 <th scope="col" width="15%">Trạng thái</th>
                                                 <th scope="col" width="10%">Thao tác </th>
                                             </tr>
                                         </thead>
                                         {{-- <tbody>
                                             @foreach ($vouchers as $voucher)
                                                 <tr  style="text-align: center;">
                                                     <td>{{ $voucher->id }}</td>
                                                     <td style="font-weight: bold;">{{ $voucher->code }}</td>
                                                     <td>{{$voucher->quantity}}</td>
                                                     <td>
                                                          @if ($voucher->type_discount == 'money')
                                                             <span class="badge bg-success">Giảm theo tiền</span>
                                                        @else
                                                             <span class="badge bg-warning">giảm theo phần trăm</span>
                                                        @endif
                                                     </td>
                                                     <td style="color: red;">
                                                        @if ($voucher->type_discount == 'money')
                                                            {{ number_format($voucher->amount)}} <span style="text-decoration: underline;">đ</span>
                                                        @else
                                                            {{ number_format($voucher->amount)}} <span>%</span>
                                                        @endif

                                                    </td>
                                                     <td style="font-weight: bold;">{{ date('Y-m-d', strtotime($voucher->start_date)) }}</td>
                                                     <td style="font-weight: bold;"><span
                                                             style="margin-left: 15px;">{{ date('Y-m-d', strtotime($voucher->end_date)) }}</span></td>

                                                     <td class="text-center">
                                                   <a
                                                            href="/admin/order/detail/{{$voucher->id}}">
                                                            <i class="fas fa-edit fa-xl"></i>
                                                        </a>

                                                        <form method="delete" style=" display:inline!important;"
                                                            action="/admin/product/delete/{{ $voucher->id }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                        <i type="submit" style="color: red;" class="fas fa-trash fa-xl show-alert-delete-box"></i>
                                                        </form>

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
                 {{-- {{ $vouchers->links('custom') }} --}}
             </div>
         </div>
     </main>

     <script>
         $(document).ready(function() {
             $('#discount-table').DataTable({
                 processing: true,
                 serverSide: true,
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
                 ajax: '{!! route('discount_data') !!}',
                 columns: [{
                         data: 'id',

                     },
                     {
                         data: 'code',

                     },
                     {
                         data: 'quantity',

                     },
                     {
                         data: 'type_discount',

                     },
                     {
                         data: 'amount',

                     },
                     {
                         data: 'active',

                     },
                     {
                         data: 'action',
                     },
                 ],

             });
         });
     </script>
     <script>
         function deleteDiscount(ev) {
             var urlToRedirect = ev.currentTarget.getAttribute('href');
             event.preventDefault();
             new swal({
                 title: "Bạn có chắc muốn xóa mã giảm giá này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
             }).then((willDelete) => {
                if (willDelete) {
                    window.location.href= urlToRedirect;
                }
            });
         }
     </script>
 @endsection
