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
                                                <th scope="col" width="10%">Trạng thái</th>
                                                <th scope="col" width="20%">Hình ảnh</th>
                                                <th scope="col" width="20%">Hãng</th>
                                                <th scope="col" class="text-end" width="20%"><span>Thao tác</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td style="font-weight: bold;">{{ $product->name }}</td>
                                                    <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                            @if ($product->active == 1)
                                                                <span class="badge bg-success">Enable</span>
                                                            @else
                                                                <span class="badge bg-danger">Disable</span>
                                                            @endif
                                                        </span></td>
                                                    <td><img src="{{ $product->images->where('type', 'cover')[0]['url'] }}"
                                                            width="100">
                                                    </td>
                                                    <td style="font-weight: bold;">{{ $product->brand->name }}</td>
                                                    <td class="text-end"> <a class="btn btn-primary btn-sm" href="/admin/product/edit/{{ $product->id}}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a class="btn btn-danger btn-sm" href="#">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
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
             
            </div>
        </div>
    </main>
   
@endsection
