@extends('admin.main')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Danh sách điện thoại</h1>
                <a class="badge bg-info text-white ms-2" href="/admin/product/add">
                    Thêm +
                </a>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body h-100">
                            <div class="container ">

                                <div class="mb-2 d-flex justify-content-between align-items-center">

                                    <div class="position-relative" style="margin-bottom: 20px;">
                                        <span class="position-absolute" style="top: 6px; left: 10px;"><i
                                                class="fa fa-search"></i></span>
                                        <input class="form-control w-100" style="text-indent: 17px;"
                                            placeholder="Tìm kiếm theo tên, mã sản phẩm...">
                                    </div>


                                </div>
                                <div class="table-responsive">
                                    <table class="table table-responsive table-borderless">

                                        <thead>
                                            <tr class="bg-light">
                                                <th scope="col" width="5%">#</th>
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
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td style="font-weight: bold;">{{ $product->name }}</td>
                                                    <td style="font-weight: bold;">{{ $product->ram }} GB -
                                                        {{ $product->rom }}</td>
                                                    <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                            @if ($product->active == 1)
                                                                <span class="badge bg-success">Enable</span>
                                                            @else
                                                                <span class="badge bg-danger">Disable</span>
                                                            @endif
                                                        </span></td>
                                                    <td><img src="{{ $product->images->where('type', 'cover')->first()['url'] }}"
                                                            width="100">
                                                    </td>
                                                    <td  style="font-weight: bold;"> <span style="margin-left: 10px;"> {{$product->quantity}} </span></td>
                                                    <td style="font-weight: bold;">{{ $product->brand->name }}</td>
                                                    <td class="text-end"> <a class="btn btn-primary btn-sm"
                                                            href="/admin/product/edit/{{ $product->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form method="delete" style=" display:inline!important;"
                                                            action="/admin/product/delete/{{ $product->id }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" style=" display:inline!important;"
                                                                class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm">
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
             {{ $products->links() }}
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
@endsection
