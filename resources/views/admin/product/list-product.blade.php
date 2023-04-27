@extends('admin.main')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Danh sách điện thoại</h1>
                @if (\Illuminate\Support\Facades\Session::get('user')->role == 1)
                <a class="badge bg-info text-white ms-2" href="/admin/product/add">
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
                                    <table class="table table-responsive table-borderless table-striped" id="product-table" style="padding-top:20px; ">

                                        <thead>
                                            <tr class="bg-warning text-dark">
                                                <th scope="col" width="7%">ID</th>
                                                <th scope="col" width="20%">Tên điện thoại</th>
                                                <th scope="col" width="15%">Dung lượng</th>

                                                <th scope="col" width="10%">Trạng thái</th>
                                                <th scope="col" width="15%">Hình ảnh</th>
                                                <th scope="col" width="10%">Số lượng</th>
                                                <th scope="col" width="10%">Hãng</th>
                                                <th scope="col" class="text-end" width="10%"><span>Thao tác</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td style="font-weight: bold;">{{ $product->name }}</td>
                                                    <td style="font-weight: bold;">{{ $product->ram }} GB -
                                                        {{ $product->rom }}</td>
                                                    <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                            @if ($product->active == 1)
                                                                <span class="badge bg-success">Kích hoạt</span>
                                                            @else
                                                                <span class="badge bg-danger">Hủy kích hoạt</span>
                                                            @endif
                                                        </span></td>
                                                    <td><img src="{{ $product->images->where('type', 'cover')->first()['url'] }}"
                                                            width="100">
                                                    </td>
                                                    <td  style="font-weight: bold;"> <span style="margin-left: 10px;"> {{$product->quantity}} </span></td>
                                                    <td style="font-weight: bold;">{{ $product->brand->name }}</td>
                                                    <td class="text-end"> <a style="margin-right:7px;"
                                                            href="/admin/product/edit/{{ $product->id }}">
                                                               <i class="fas fa-edit fa-xl"></i>
                                                        </a>

                                                        <form method="delete" style=" display:inline!important;"
                                                            action="/admin/product/delete/{{ $product->id }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <i type="submit" style="color: red;" class="fas fa-trash fa-xl show-alert-delete-box"></i>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             {{-- {{ $products->links('custom') }} --}}
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
       <script>
         $(document).ready(function() {
             $('#product-table').DataTable({
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
                 ajax: '{!! route('product_data') !!}',
                 columns: [{
                         data: 'id',

                     },
                     {
                         data: 'name',

                     },
                     {
                         data: 'size_memory',

                     },
                      {
                         data: 'active',

                     },
                     {
                         data: 'image',
                     },
                     {
                         data: 'quantity',
                     },
                     {
                         data: 'brand_id',

                     },
                     {
                         data: 'action',

                     },
                 ],

             });
         });
     </script>
      <script>
         function deleteProduct(ev) {
             var urlToRedirect = ev.currentTarget.getAttribute('href');
             event.preventDefault();
             new swal({
                 title: "Bạn có chắc muốn xóa điện thoại này không?",
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
