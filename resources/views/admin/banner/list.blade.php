@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Danh sách banner</h1>
            {{-- <a class="badge bg-info text-white ms-2" href="/admin/banner/add">
                Thêm +
            </a> --}}
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body h-100">
                        <div class="container ">


                            <div class="table-responsive">
                                <table class="table table-responsive table-borderless table-striped" id="banner-data"
                                    style="padding-top:20px;">

                                    <thead>
                                        <tr class="bg-warning text-dark">
                                            <th scope="col" width="7%">ID</th>
                                            <th scope="col" width="15%">Tên banner</th>
                                            <th scope="col" width="19%">Sản phẩm quảng bá</th>
                                            <th scope="col" width="13%">Trạng thái</th>
                                            <th scope="col" width="15%">Hình ảnh</th>
                                            <th scope="col" width="12%">Loại banner</th>
                                            <th scope="col" width="11%"><span>Thao tác</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td style="font-weight: bold;">{{ $banner->header }}</td>
                                            <td style="font-weight: bold;">{{ $banner->product_name }} GB</td>
                                            <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                    @if ($banner->active == 1)
                                                    <span class="badge bg-success">Kích hoạt</span>
                                                    @else
                                                    <span class="badge bg-danger">Hủy kích hoạt</span>
                                                    @endif
                                                </span></td>
                                            <td><img src="{{ $banner->thumb }}" width="100">
                                            </td>
                                            <td style="font-weight: bold;">{{ $banner->type_banner }}</td>
                                            <td style="font-weight: bold;"><span style="margin-left: 15px;">{{
                                                    $banner->sort_by }}</span></td>

                                            <td>
                                                <a href="/admin/banner/edit/{{ $banner->id }}">
                                                    <i class="fas fa-edit fa-xl"></i>
                                                </a>

                                                <form method="delete" style=" display:inline!important;"
                                                    action="/admin/banner/delete/{{ $banner->id }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <i type="submit" style="color: red;"
                                                        class="fas fa-trash fa-xl show-alert-delete-box"></i>
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
            {{-- {{ $banners->links('custom') }} --}}
        </div>
    </div>
</main>

<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event) {
             var form = $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn xóa banner này không?",
                 text: "Xóa là mất luôn đó :(.",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Đã xóa!'
             }).then((willDelete) => {
                 if (willDelete) {
                     form.submit();
                 }
             });
         });
</script>
<script>
    $(document).ready(function() {
             $('#banner-data').DataTable({
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
                 ajax: '{!! route('banner_data') !!}',
                 columns: [{
                         data: 'id',
                      },
                      {
                          data: 'header',

                      },
                      {
                          data: 'product_name',

                      },
                       {
                          data: 'active',
                      },
                      {
                          data: 'thumb',
                      },
                     {
                    data: 'type_banner',
                    "render": function(data, type, row, meta) {
                    if (row["type_banner"] == "header") {
                    return `<i class="fa fa-check-circle-o green"></i><span class="ms-1">
                        <span class="badge bg-success">Carousel</span>`
                        } else if(row["type_banner"] == "header static"){
                        return `<i class="fa fa-check-circle-o green"></i><span class="ms-1">
                            <span class="badge bg-success">Tiêu đề</span>`
                            } else if(row["type_banner"] == "broadcast"){
                            return `<i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                <span class="badge bg-warning">Cuối trang</span>`
                                } else {
                                    return `<i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                        <span class="badge bg-danger">Giữa trang</span>`
                                        }
                                        }
                                        },
                      {
                          data: 'action',
                      },
                 ],
             });
         });
</script>
<script>
    function deleteBanner(ev) {
             var urlToRedirect = ev.currentTarget.getAttribute('href');
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn xóa banner này không?",
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

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection
