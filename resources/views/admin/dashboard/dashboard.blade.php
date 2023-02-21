@extends('admin.main')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Dữ liệu</strong> Phân tích</h1>
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
                                            @if($increaseTotalAvanue > 0)
                                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> +{{ round($increaseTotalAvanue,2) }} %
                                                </span>
                                            @else
                                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -{{ round($increaseTotalAvanue,2) }} %
                                                </span>
                                            @endif

                                            <span class="text-muted">Tuần trước</span>
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

                            <h5 class="card-title mb-0">Biểu đồ đơn hàng theo ngày</h5>
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

                            <h5 class="card-title mb-0">Biểu đồ doanh thu</h5>
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

                            <h5 class="card-title mb-0">Phương thức thanh toán</h5>
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
                                               @foreach ($pieChartData['labels'] as $paymentMethod)
                                                <tr>
													<td>{{$paymentMethod}}</td>
													<td class="text-end">{{$pieChartData['data'][$loop->index]}}</td>
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
    </main>


@endsection
    <script>
        document.addEventListener("DOMContentLoaded", function() {
             var labelPieChart = '{!! json_encode($pieChartData['labels']) !!}';
            labelPieChart = JSON.parse(labelPieChart);
               var dataPieChart = '{!! json_encode($pieChartData['data']) !!}';
            dataPieChart = JSON.parse(dataPieChart);
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: labelPieChart,
                    datasets: [{
                        data: dataPieChart,
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
        });
    </script>

     <script>
        document.addEventListener("DOMContentLoaded", function() {
            var labelRowChart = '{!! json_encode($rowChartData['labels']) !!}';
            labelRowChart = JSON.parse(labelRowChart);
               var dataRowChart = '{!! json_encode($rowChartData['data']) !!}';
            dataRowChart = JSON.parse(dataRowChart);
                    new Chart(document.getElementById("chartjs-bar"), {
                        type: "bar",
                        data: {
                            labels: labelRowChart,
                            datasets: [{
                                label: "Doanh thu hàng ngày",
                                backgroundColor: "#F5B041",
                                borderColor: window.theme.primary,
                                hoverBackgroundColor: window.theme.primary,
                                hoverBorderColor: window.theme.primary,
                                data: dataRowChart,
                                barPercentage: .75,
                                categoryPercentage: .5
                            }]
                        },
                        options: {
                         plugins: {
                           datalabels: {
                            display: true,
                            color: 'white',
                            font: {
                                weight: 'bold'
                            },
                            formatter: function (value, context) {
                                return context.chart.data.labels[context.dataIndex] + ' ' + value;
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                if (parseInt(value) >= 1000) {
                                return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                return value;
                                }
                                }
                            },

                        }]
                    },
                        },

                    });
                });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
             var labelRowChart = '{!! json_encode($totalOrderData['labels']) !!}';
            labelRowChart = JSON.parse(labelRowChart);
               var dataRowChart = '{!! json_encode($totalOrderData['data']) !!}';
            dataRowChart = JSON.parse(dataRowChart);
            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: labelRowChart,
                    datasets: [{
                        label: "Số đơn ($)",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        data: dataRowChart
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });
        });
    </script>

