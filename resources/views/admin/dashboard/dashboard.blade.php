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
                                                <a href="/admin/product/list"><i class="align-middle" data-feather="monitor"></i></a>
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
                                                <a href="/admin/users"><i class="align-middle" data-feather="users"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $users }}</h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                            @if($increaseTotalUser >= 0)
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> +{{
                                                round($increaseTotalUser,0) }} %
                                            </span>
                                            @else
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{
                                                round($increaseTotalUser,0) }} %
                                            </span>
                                            @endif

                                            <span class="text-muted">với tháng trước</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Doanh thu tháng</h5>
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
                                        @if($increaseTotalAvanue >= 0)
                                        <span class="text-success" > <i class="mdi mdi-arrow-bottom-right"></i> +{{
                                            round($increaseTotalAvanue,0) }} %
                                        </span>
                                        @else
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{
                                            round($increaseTotalAvanue,0) }} %
                                        </span>
                                        @endif

                                        <span class="text-muted" style="height: 20px;">với tháng trước</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Đơn hàng tháng</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                               <a href="/admin/order/lists"> <i class="align-middle" data-feather="shopping-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ count($orders) }}</h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                            @if($increaseTotalOrder >= 0)
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> +{{
                                                round($increaseTotalOrder,0) }} %
                                            </span>
                                            @else
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{
                                                round($increaseTotalOrder,0) }} %
                                            </span>
                                            @endif

                                            <span class="text-muted">với tháng trước</span>
                                        </span>
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
            <div class="col-12 col-lg-8 col-xxl-8 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Biểu đồ doanh thu theo ngày</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-bar-date" class="chart-date"></canvas>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-4 d-flex">
                <div class="card flex-fill">

                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="pie-chart-payment" width="900" height="900"></canvas>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-12 col-lg-8 col-xxl-8 d-flex">
                <div class="card flex-fill" >
                    <div class="card-header">
                        <h5 class="card-title mb-0">Biểu đồ doanh thu theo tháng</h5>
                    </div>

                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-bar-month" class="chart-month"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-4 d-flex">
                <div class="card flex-fill">

                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="pie-chart-order" width="900" height="900"></canvas>
                        </div>
                    </div>

                </div>

            </div>
            {{-- <div class="col-12 col-lg-4 col-xxl-3 d-flex">
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

            </div> --}}
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                           <canvas id="bar-chart" width="800" height="450"></canvas>
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
                    new Chart(document.getElementById("chartjs-bar-date"), {
                        type: "bar",
                        data: {
                            labels: labelRowChart,
                            datasets: [{
                                label: "Doanh thu hàng ngày",
                                backgroundColor:'rgba(255, 159, 64, 0.2)',
                                borderColor: 'rgb(255, 159, 64)',
                                hoverBackgroundColor: 'rgba(255, 99, 132, 0.2)',
                                hoverBorderColor: 'rgb(255, 99, 132)',
                                borderWidth: 1,
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
            var labelRowChart = '{!! json_encode($rowChartDataFor7Months['labels']) !!}';
            labelRowChart = JSON.parse(labelRowChart);
               var dataRowChart = '{!! json_encode($rowChartDataFor7Months['data']) !!}';
            dataRowChart = JSON.parse(dataRowChart);
                    new Chart(document.getElementById("chartjs-bar-month"), {
                        type: "bar",
                        data: {
                            labels: labelRowChart,
                            datasets: [{
                                label: "Doanh thu theo tháng",
                                backgroundColor:'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgb(255, 99, 132)',
                                hoverBackgroundColor: 'rgba(255, 99, 132, 0.2)',
                                hoverBorderColor: 'rgb(255, 99, 132)',
                                borderWidth: 1,
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
            // var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: labelRowChart,
                    datasets: [{
                        label: "Số đơn: ",
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
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

                    scales: {

                        yAxes: [{
                            ticks: {
                                stepSize: 1,
                                beginAtZero: true,
                            },

                        }]
                    }
                }
            });
        });
</script>

<script>
    //pie chart payment method
    document.addEventListener("DOMContentLoaded", function() {
        var labelPieChart = '{!! json_encode($pieChartData['labels']) !!}';
        labelPieChart = JSON.parse(labelPieChart);
        var dataPieChart = '{!! json_encode($pieChartData['data']) !!}';
        dataPieChart = JSON.parse(dataPieChart);

        new Chart(document.getElementById("pie-chart-payment"), {
            type: 'pie',
            data: {
                labels: labelPieChart,
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ['rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'],
                    data: dataPieChart,
                    hoverOffset: 4
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Các phương thức thanh toán'
                }
            }
        });

    });
</script>

<script>
    //pie chart order status
    document.addEventListener("DOMContentLoaded", function() {
        var labelPieChart = '{!! json_encode($pieChartOrderStatus['labels']) !!}';
        labelPieChart = JSON.parse(labelPieChart);
        var dataPieChart = '{!! json_encode($pieChartOrderStatus['data']) !!}';
        dataPieChart = JSON.parse(dataPieChart);

        new Chart(document.getElementById("pie-chart-order"), {
            type: 'pie',
            data: {
                labels: labelPieChart,
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ['rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(153, 102, 255)',
                   'rgb(75, 192, 192)',
                  ],
                    data: dataPieChart,
                    hoverOffset: 4
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Trạng thái đơn hàng'
                }
            }
        });

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var labelRowChart = '{!! json_encode($top7Product['labels']) !!}';
        labelRowChart = JSON.parse(labelRowChart);
        var dataRowChart = '{!! json_encode($top7Product['data']) !!}';
        dataRowChart = JSON.parse(dataRowChart);
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: labelRowChart,
                datasets: [{
                    label: "Số sản phẩm bán được",
                    backgroundColor: ['rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'],
                    data: dataRowChart,
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Top 7 sản phẩm bán chạy nhất (theo số lượng)'
                },
                scales: {
                yAxes: [{
                   ticks: {
                     stepSize: 5,
                     beginAtZero: true,
                },
                }]
                }

            }
        });
    });
</script>
