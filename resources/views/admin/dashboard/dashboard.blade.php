@extends('admin.main')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Dữ liệu</strong> Phân tích</h1>
            <?php $summary = 0; ?>
            @foreach ($orders as $item)
                <?php $summary += $item->total; ?>
            @endforeach
            <div class="row">
                <div class="col-xl-6 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Sản phẩm</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="monitor"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ count($products) }}</h1>
                                        <div class="mb-0" style="padding-bottom: 22px;">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Khách hàng</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ $users }}</h1>
                                        <div class="mb-0">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> +5.25%
                                            </span>
                                            <span class="text-muted">So với tháng trước</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Doanh thu tuần</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="mt-1 mb-3" style="padding: 5px 0px 5px 0px;">
                                            {{ number_format($summary, 0, ',', '.') }} đ</h3>
                                        <div class="mb-0">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> +6.65%
                                            </span>
                                            <span class="text-muted">So với tháng trước</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Đơn hàng tuần</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ count($orders) }}</h1>
                                        <div class="mb-0">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25%
                                            </span>
                                            <span class="text-muted">So với tháng trước</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-xxl-7">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Biểu đồ doanh thu</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-line"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Đơn hàng mới nhất</h5>
                        </div>
                        {{-- <table class="table table-hover my-0">
                            <thead>
                                <tr class="bg-warning text-dark" style="text-align: center;">
                                    <th>Tên khách hàng</th>
                                    <th class="d-none d-xl-table-cell">Ngày đặt hàng</th>
                                    <th class="d-none d-xl-table-cell">Tổng đơn</th>
                                    <th>Trạng thái đơn hàng</th>
                                    <th class="d-none d-md-table-cell">Thao tác
                                    </tr>
                                        @foreach ($orderNews as $order)
                                <tr style="text-align: center;">
                                    <td>{{ $order->user->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->created_at }}</td>
                                    <td class="d-none d-xl-table-cell" style="color: red;">{{ number_format($order->total) }} <span
                                            style="text-decoration: underline;">đ</span></td>
                                    <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                            @if ($order->status->id == 1)
                                                                <span class="badge bg-secondary">Chờ xác nhận</span>
                                                            @elseif ($order->status->id == 2)
                                                                <span class="badge bg-success">Đã xác nhận</span>
                                                            @elseif ($order->status->id == 3)
                                                                <span class="badge bg-warning">Đang giao hàng</span>
                                                            @elseif ($order->status->id == 4)
                                                                <span class="badge bg-info text-dark">Giao hàng thành công</span>
                                                            @elseif ($order->status->id == 5)
                                                                <span class="badge bg-danger">Đã hủy</span>
                                                            @endif
                                                        </span></td>
                                        <td><a href="/admin/order/detail/{{$order->id}}">
                                            <i class="fas fa-edit fa-xl"></i>
                                        </a>
                                        <form method="delete" style=" display:inline!important;"
                                            action="/admin/product/delete/{{ $order->id }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <i type="submit" style="color: red;"
                                                class="fas fa-trash fa-xl show-alert-delete-box"></i>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                        </table> --}}
                        <div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chartjs-bar"></canvas>
									</div>
								</div>

                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Đơn hàng mỗi tháng</h5>
                        </div>
                        <div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="py-3">
											<div class="chart chart-xs">
												<canvas id="chartjs-dashboard-pie"></canvas>
											</div>
										</div>

										<table class="table mb-0">
											<tbody>
												<tr>
													<td>Chrome</td>
													<td class="text-end">4306</td>
												</tr>
												<tr>
													<td>Firefox</td>
													<td class="text-end">3801</td>
												</tr>
												<tr>
													<td>IE</td>
													<td class="text-end">1689</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
