 @extends('admin.main')
 @section('content')
     <main class="content">
         <div class="container-fluid">

             <div class="mb-3">
                 <h1 class="h3 d-inline align-middle">Danh sách khách hàng</h1>
             </div>
             <div class="row">
                 <div class="col-md-12 col-xl-12">
                     <div class="card">
                         <div class="card-body h-100">
                             <div class="container ">
                                 <div class="table-responsive">
                                     <table class="table table-responsive table-borderless table-striped" id="user-table" style="padding-top: 20px;">
                                         <thead style="text-align: center;">
                                             <tr class="bg-warning text-dark">
                                                 <th scope="col" width="7%">ID</th>
                                                 <th scope="col" width="20%" style="text-align: left;">Tên khách hàng</th>
                                                 <th scope="col" width="20%" style="text-align: left;">Email</th>
                                                 <th scope="col" width="12%">Trạng thái</th>
                                                 <th scope="col" width="13%">Hình ảnh</th>
                                                 <th scope="col" width="13%">Số điện thoại</th>
                                                 <th scope="col"  width="15%"><span>Thao tác</span>
                                                 </th>
                                             </tr>
                                         </thead>
                                         {{-- <tbody >
                                             @foreach ($users as $user)
                                                 <tr style="text-align: center;" >
                                                     <td>{{ $user->id }}</td>
                                                     <td style="font-weight: bold; text-align: left;">{{ $user->name }}</td>
                                                     <td style="font-weight: bold; text-align: left;">{{ $user->email }}</td>
                                                     <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                             @if ($user->active == 1)
                                                                 <span class="badge bg-success">Kích hoạt</span>
                                                             @else
                                                                 <span class="badge bg-danger">Khóa</span>
                                                             @endif
                                                         </span></td>
                                                     <td><img src="{{ $user->avatar }}" width="40"
                                                             style="border-radius: 50%;">
                                                     </td>
                                                     <td style="font-weight: bold;">{{ $user->phone }}</td>

                                                     <td class="text-end">
                                                         @if ($user->active == 0)
                                                             <form method="post" style=" display:inline!important; margin-right: 20px;"
                                                                 action="/admin/users/change-active/{{ $user->id }}?active=1">
                                                                 @csrf
                                                                 <input name="_method" type="hidden" value="POST">
                                                                    <i class="fa fa-unlock fa-xl show-alert-active-box" style="color: blue;cursor: pointer;" aria-hidden="true"></i>
                                                             </form>
                                                         @else

                                                             <form method="post" style=" display:inline!important; margin-right: 20px;"
                                                                 action="/admin/users/change-active/{{ $user->id }}?active=0">
                                                                 @csrf
                                                                 <input name="_method" type="hidden" value="POST">
                                                                    <i class="fa fa-lock fa-xl show-alert-delete-box " style="color: red;cursor: pointer;   " aria-hidden="true"></i>
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
                  {{-- {{ $users->links('custom') }} --}}
             </div>
         </div>
     </main>

     <script type="text/javascript">
         $('.show-alert-delete-box').click(function(event) {
             var form = $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn khóa tài khoản này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Đã khóa tài khoản!'
             }).then((willDelete) => {
                 if (willDelete) {
                  swal({
                         title: 'Thành công!',
                         icon: 'success',
                         text: 'Đã khóa tài khoản!',
                         type: 'success'
                     }).then(function() {
                         form.submit();
                     });
                }
             });
         });
     </script>

     <script type="text/javascript">
         $('.show-alert-active-box').click(function(event) {
             var form = $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             //const swal = new SweetAlert2();
             swal({
                 title: "Bạn có chắc muốn kích hoạt tài khoản này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Đã kích hoạt tài khoản!'
             }).then((willDelete) => {
                 if (willDelete) {
                     swal({
                         title: 'Thành công!',
                         icon: 'success',
                         text: 'Đã kích hoạt tài khoản!',
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
             $('#user-table').DataTable({
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
                 ajax: '{!! route('user_data') !!}',
                 columns: [{
                         data: 'id',

                     },
                     {
                         data: 'name',

                     },
                     {
                         data: 'email',

                     },
                      {
                         data: 'active',

                     },
                     {
                         data: 'avatar',
                     },
                     {
                         data: 'phone',
                     },
                     {
                         data: 'action',
                     },
                 ],

             });
         });
     </script>
      <script>
         function activeUser(ev) {
             var urlToRedirect = ev.currentTarget.getAttribute('href');
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn kích hoạt tài khoản này không?",
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
      <script>
         function blockUser(ev) {
             var urlToRedirect = ev.currentTarget.getAttribute('href');
             event.preventDefault();
             new swal({
                 title: "Bạn có chắc muốn khóa tài khoản này không?",
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

 @section('footer')
     <script>
         CKEDITOR.replace('content');
     </script>
 @endsection
