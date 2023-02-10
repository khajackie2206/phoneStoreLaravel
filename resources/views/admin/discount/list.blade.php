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
                                     <table  id="discount-table" class="table table-responsive table-borderless table-striped" >

                                         <thead>
                                             <tr class="bg-warning text-dark" style="text-align: center;margin-top: 15px;">
                                                 <th scope="col" width="5%">#</th>
                                                 <th scope="col" width="12%">Mã giảm giá</th>
                                                 <th scope="col" width="10%">Số lượng</th>
                                                 <th scope="col" width="15%">Loại giảm giá</th>
                                                 <th scope="col" width="13%">Giá trị</th>
                                                 <th scope="col" width="15%">Ngày bắt đầu</th>
                                                 <th scope="col" width="15%">Ngày kết thúc </th>
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
     <script type="text/javascript">
         $('.show-alert-delete-brand').click(function(event) {
             var form = $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn xóa thương hiệu này không?",
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
                         text: 'Đã xóa thương hiệu!',
                         type: 'success'
                     }).then(function() {
                         form.submit();
                     });
                 }
             });
         });
     </script>
     <script type="text/javascript">
         $('.show-alert-deactive-brand').click(function(event) {
             var form = $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn hủy kích hoạt thương hiệu này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Đã hủy kích hoạt!'
             }).then((willDelete) => {
                 if (willDelete) {
                     swal({
                         title: 'Thành công!',
                         icon: 'success',
                         text: 'Đã hủy kích hoạt!',
                         type: 'success'
                     }).then(function() {
                         form.submit();
                     });
                 }
             });
         });
     </script>

     <script type="text/javascript">
         $('.show-alert-active-brand').click(function(event) {
             var form = $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             //const swal = new SweetAlert2();
             swal({
                 title: "Bạn có chắc muốn kích hoạt thương hiệu này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Đã kích hoạt!'
             }).then((willDelete) => {
                 if (willDelete) {
                     swal({
                         title: 'Thành công!',
                         icon: 'success',
                         text: 'Đã kích hoạt thương hiệu!',
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
             $('#discount-table').DataTable({
                 processing: true,
                 serverSide: true,
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
                         data: 'start_date',

                     },
                     {
                         data: 'end_date',

                     },
                     {
                         data: 'action',
                     },
                 ],

             });
         });
     </script>
     <script>
         function myFunction(ev) {
             var urlToRedirect = ev.currentTarget.getAttribute('href');
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn xóa mã giảm giá này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Đã kích hoạt!'
             }).then((willDelete) => {
                if (willDelete) {
                    window.location.href='url';
                }
            });
         }
     </script>
 @endsection
