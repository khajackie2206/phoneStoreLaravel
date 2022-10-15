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
                                     <table class="table table-responsive table-borderless">

                                         <thead>
                                             <tr class="bg-light">
                                                 <th scope="col" width="5%">#</th>
                                                 <th scope="col" width="20%">Tên thương hiệu</th>
                                                 <th scope="col" width="15%">Trạng thái</th>
                                                 <th scope="col" width="20%">Hình ảnh</th>
                                                 <th scope="col" width="15%">Quốc gia</th>
                                                 <th scope="col" width="10%">Mô tả</th>
                                                 <th scope="col" class="text-center" width="15%"><span>Thao
                                                         tác</span>
                                                 </th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($brands as $brand)
                                                 <tr>
                                                     <td>{{ $brand->id }}</td>
                                                     <td style="font-weight: bold;">{{ $brand->name }}</td>
                                                     <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                             @if ($brand->active == 1)
                                                                 <span class="badge bg-success">Enable</span>
                                                             @else
                                                                 <span class="badge bg-danger">Disable</span>
                                                             @endif
                                                         </span></td>
                                                     <td><img src="{{ $brand->image }}" width="50">
                                                     </td>
                                                     <td style="font-weight: bold;">{{ $brand->country }}</td>
                                                     <td style="font-weight: bold;"><span
                                                             style="margin-left: 15px;">{{ $brand->sort_by }}</span></td>

                                                     <td class="text-center">
                                                         <a class="btn btn-primary btn-sm"
                                                             href="/admin/brand/edit/{{ $brand->id }}">
                                                             <i class="fas fa-edit"></i>
                                                         </a>
                                                         @if ($brand->active == 1)
                                                             <form method="post" style=" display:inline!important;"
                                                                 action="/admin/brand/change-status/{{ $brand->id }}?active=0">
                                                                 @csrf
                                                                 <input name="_method" type="hidden" value="POST">
                                                                 <button type="submit" style=" display:inline!important;"
                                                                     class="btn btn-xs btn-danger btn-flat btn-sm show-alert-deactive-brand">
                                                                     <i class="fas fa-close"></i></button>
                                                             </form>
                                                         @else
                                                             <form method="post" style=" display:inline!important;"
                                                                 action="/admin/brand/change-status/{{ $brand->id }}?active=1">
                                                                 @csrf
                                                                 <input name="_method" type="hidden" value="POST">
                                                                 <button type="submit" style=" display:inline!important;"
                                                                     class="btn btn-xs btn-primary btn-flat btn-sm show-alert-active-brand">
                                                                     <i class="fas fa-check"></i></button>
                                                             </form>
                                                         @endif


                                                         <form method="POST" style=" display:inline!important;"
                                                             action="/admin/brand/delete/{{ $brand->id }}">
                                                             @csrf
                                                             <input name="_method" type="hidden" value="POST">
                                                             <button type="submit" style=" display:inline!important;"
                                                                 class="btn btn-xs btn-danger btn-flat btn-sm show-alert-delete-brand">
                                                                 <i class="fas fa-trash"></i></button>
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
                 {{ $brands->links() }}
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
 @endsection
