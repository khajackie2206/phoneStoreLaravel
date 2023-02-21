 @extends('admin.main')
 @section('content')
     <main class="content">
         <div class="container-fluid">

             <div class="mb-3">
                 <h1 class="h3 d-inline align-middle">Danh sách thương hiệu</h1>
                 <a class="badge bg-info text-white ms-2" href="/admin/brand/add">
                     Thêm +
                 </a>
             </div>
             <div class="row">
                 <div class="col-md-12 col-xl-12">
                     <div class="card">
                         <div class="card-body h-100">
                             <div class="container ">


                                 <div class="table-responsive">
                                     <table class="table table-responsive table-borderless table-striped" id="brand-table" style="padding-top: 20px;">

                                         <thead>
                                             <tr class="bg-warning text-dark" style="text-align: center;">
                                                 <th scope="col" width="5%">#</th>
                                                 <th scope="col" width="20%">Tên thương hiệu</th>
                                                 <th scope="col" width="15%">Hình ảnh</th>
                                                 <th scope="col" width="20%">Trạng thái</th>
                                                 <th scope="col" width="15%">Quốc gia</th>
                                                 <th scope="col" width="10%">Mô tả</th>
                                                 <th scope="col" width="15%"><span style="margin-left: 10px;">Thao
                                                         tác</span>
                                                 </th>
                                             </tr>
                                         </thead>
                                         {{-- <tbody>
                                             @foreach ($brands as $brand)
                                                 <tr>
                                                     <td>{{ $brand->id }}</td>
                                                     <td style="font-weight: bold;">{{ $brand->name }}</td>
                                                     <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                             @if ($brand->active == 1)
                                                                 <span class="badge bg-success">Kích hoạt</span>
                                                             @else
                                                                 <span class="badge bg-danger">Hủy kích hoạt</span>
                                                             @endif
                                                         </span></td>
                                                     <td><img src="{{ $brand->image }}" width="50" >
                                                     </td>
                                                     <td style="font-weight: bold;">{{ $brand->country }}</td>
                                                     <td style="font-weight: bold;"><span
                                                             style="margin-left: 15px;">{{ $brand->sort_by }}</span></td>

                                                     <td class="text-center">
                                                         <a style="margin-right: 5px;"
                                                             href="/admin/brand/edit/{{ $brand->id }}">
                                                             <i class="fas fa-edit fa-xl"></i>
                                                         </a>
                                                         @if ($brand->active == 1)
                                                             <form method="post" style=" display:inline!important;margin-right: 5px; cursor: pointer;"
                                                                 action="/admin/brand/change-status/{{ $brand->id }}?active=0">
                                                                 @csrf
                                                                 <input name="_method" type="hidden" value="POST">

                                                                     <i class="fa fa-ban fa-xl show-alert-deactive-brand" style="color: #0d6efd;"></i>
                                                             </form>
                                                         @else
                                                             <form method="post" style=" display:inline!important;margin-right: 5px;"
                                                                 action="/admin/brand/change-status/{{ $brand->id }}?active=1">
                                                                 @csrf
                                                                 <input name="_method" type="hidden" value="POST">
                                                                     <i class="fas fa-check-square fa-xl show-alert-active-brand" style="color: #0d6efd;"></i>
                                                             </form>
                                                         @endif


                                                         <form method="POST" style=" display:inline!important;"
                                                             action="/admin/brand/delete/{{ $brand->id }}">
                                                             @csrf
                                                             <input name="_method" type="hidden" value="POST">
                                                                 <i type="submit" class="fas fa-trash fa-xl show-alert-delete-brand" style="color: red;"></i>
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
                 {{-- {{ $brands->links('custom') }} --}}
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

     {{-- <script type="text/javascript">
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
     </script> --}}
        <script>
         $(document).ready(function() {
             $('#brand-table').DataTable({
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
                 ajax: '{!! route('brand_data') !!}',
                 columns: [{
                         data: 'id',

                     },
                     {
                         data: 'name',

                     },
                     {
                         data: 'image',

                     },
                      {
                         data: 'active',

                     },
                     {
                         data: 'country',
                     },
                     {
                         data: 'description',
                     },
                     {
                         data: 'action',

                     },
                 ],

             });
         });
     </script>
      <script>
         function deleteBrand(ev) {
             var urlToRedirect = ev.currentTarget.getAttribute('href');
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn xóa thương hiệu này không?",
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
