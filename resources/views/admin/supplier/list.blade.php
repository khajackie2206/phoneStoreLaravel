@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Danh sách nhà cung cấp</h1>
            @if (\Illuminate\Support\Facades\Session::get('user')->role == 1)
            <a class="badge bg-info text-white ms-2" href="/admin/suppliers/add">
                Thêm +
            </a>
            @endif
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body h-100">
                        <div class="container ">
                            <div class="table-responsive">
                                <table class="table table-responsive table-borderless table-striped" id="supplier-table"
                                    style="padding-top: 20px;">
                                    <thead style="text-align: center;">
                                        <tr class="bg-warning text-dark">
                                            <th scope="col" width="7%">ID</th>
                                            <th scope="col" width="18%" style="text-align: left;">Nhà cung cấp</th>
                                            <th scope="col" width="15%" style="text-align: left;">Email</th>
                                            <th scope="col" width="15%">Số điện thoại</th>
                                            <th scope="col" width="20%">Địa chỉ</th>
                                            <th scope="col" width="15%"><span>Trạng thái</span>
                                            <th scope="col" width="10%"><span>Thao tác</span>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
             $('#supplier-table').DataTable({
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
                 ajax: '{!! route('supplier_data') !!}',
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
                         data: 'phone',

                     },
                     {
                         data: 'address',
                     },
                     {
                    data: 'status',
                    },
                     {
                         data: 'action',
                     },
                 ],

             });
         });
</script>



@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection
