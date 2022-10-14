 @extends('admin.main')
 @section('content')
     <main class="content">
         <div class="container-fluid">

             <div class="mb-3">
                 <h1 class="h3 d-inline align-middle">Danh sách User</h1>
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
                                                 <th scope="col" width="25%">Tên khách hàng</th>
                                                 <th scope="col" width="20%">Email</th>
                                                 <th scope="col" width="10%">Trạng thái</th>
                                                 <th scope="col" width="10%">Hình ảnh</th>
                                                 <th scope="col" width="15%">Số điện thoại</th>
                                                 <th scope="col" class="text-end" width="15%"><span>Thao tác</span>
                                                 </th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($users as $user)
                                                 <tr>
                                                     <td>{{ $user->id }}</td>
                                                     <td style="font-weight: bold;">{{ $user->name }}</td>
                                                     <td style="font-weight: bold;">{{ $user->email }}</td>
                                                     <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                             @if ($user->active == 1)
                                                                 <span class="badge bg-success">Enable</span>
                                                             @else
                                                                 <span class="badge bg-danger">Disable</span>
                                                             @endif
                                                         </span></td>
                                                     <td><img src="{{ $user->avatar }}" width="50"
                                                             style="border-radius: 50%;">
                                                     </td>
                                                     <td style="font-weight: bold;">{{ $user->phone }}</td>

                                                     <td class="text-end">
                                                         @if ($user->active == 0)
                                                             <form method="post" style=" display:inline!important; margin-right: 15px;"
                                                                 action="/admin/users/change-active/{{ $user->id }}?active=1">
                                                                 @csrf
                                                                 <input name="_method" type="hidden" value="POST">
                                                                 <button type="submit" style=" display:inline!important;"
                                                                     class="btn btn-xs btn-primary btn-flat btn-sm show-alert-active-box ">
                                                                     <i class="fas fa-check"></i></button>
                                                             </form>
                                                         @else
                                                             <form method="post" style=" display:inline!important;"
                                                                 action="/admin/users/change-active/{{ $user->id }}?active=1">
                                                                 @csrf
                                                                 <input name="_method" type="hidden" value="POST">
                                                                 <button type="submit" style=" display:inline!important;"
                                                                     class="btn btn-xs btn-primary btn-flat btn-sm show-alert-active-box ">
                                                                     <i class="fas fa-check"></i></button>
                                                             </form>
                                                             <form method="post" style=" display:inline!important;"
                                                                 action="/admin/users/change-active/{{ $user->id }}?active=0">
                                                                 @csrf
                                                                 <input name="_method" type="hidden" value="POST">
                                                                 <button type="submit" style=" display:inline!important;"
                                                                     class="btn btn-xs btn-danger btn-flat btn-sm show-alert-delete-box ">
                                                                     <i class="fas fa-close"></i></button>
                                                             </form>
                                                         @endif
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
                  {{ $users->links() }}
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
                     form.submit();
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
                     form.submit();
                 }
             });
         });
     </script>
 @endsection

 @section('footer')
     <script>
         CKEDITOR.replace('content');
     </script>
 @endsection
