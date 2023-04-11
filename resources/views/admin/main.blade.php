<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :not(.pagination-product) {}
    </style>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="{{ asset('Jquery/jquery-3.6.4.min.js') }}" rel="stylesheet"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('canvas-js/canvasjs.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
</head>

<body>
    @include('sweetalert::alert')
    <div class="wrapper">
        @include('admin.sidebar')
        <div class="main" style="background-color: white">
            @include('admin.header')
            @yield('content')
            @include('admin.footer')
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "This year",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                        barPercentage: .75,
                        categoryPercentage: .5
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20
                            }
                        }],
                        xAxes: [{
                            stacked: false,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var markers = [{
                    coords: [31.230391, 121.473701],
                    name: "Shanghai"
                },
                {
                    coords: [28.704060, 77.102493],
                    name: "Delhi"
                },
                {
                    coords: [6.524379, 3.379206],
                    name: "Lagos"
                },
                {
                    coords: [35.689487, 139.691711],
                    name: "Tokyo"
                },
                {
                    coords: [23.129110, 113.264381],
                    name: "Guangzhou"
                },
                {
                    coords: [40.7127837, -74.0059413],
                    name: "New York"
                },
                {
                    coords: [34.052235, -118.243683],
                    name: "Los Angeles"
                },
                {
                    coords: [41.878113, -87.629799],
                    name: "Chicago"
                },
                {
                    coords: [51.507351, -0.127758],
                    name: "London"
                },
                {
                    coords: [40.416775, -3.703790],
                    name: "Madrid "
                }
            ];
            var map = new jsVectorMap({
                map: "world",
                selector: "#world_map",
                zoomButtons: true,
                markers: markers,
                markerStyle: {
                    initial: {
                        r: 9,
                        strokeWidth: 7,
                        stokeOpacity: .4,
                        fill: window.theme.primary
                    },
                    hover: {
                        fill: window.theme.primary,
                        stroke: window.theme.primary
                    }
                },
                zoomOnScroll: false
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
            var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span title=\"Previous month\">&laquo;</span>",
                nextArrow: "<span title=\"Next month\">&raquo;</span>",
                defaultDate: defaultDate
            });
        });
    </script>
    <script>
        //Get current path to active location
        var path = window.location.href;

        if (path.includes("/admin/order/")) {
            document.getElementById("sidebar-order").classList.add("active");
        }
        if (path.includes("/admin/product")) {
            document.getElementById("sidebar-product").classList.add("active");
        }

        if (path.includes("/admin/brand/")) {
            document.getElementById("sidebar-brand").classList.add("active");
        }

        if (path.includes("/admin/banner/")) {
            document.getElementById("sidebar-banner").classList.add("active");
        }

        if (path.includes("/admin/comments/")) {
            document.getElementById("sidebar-comments").classList.add("active");
        }

        if (path.includes("/admin/discount/")) {
            document.getElementById("sidebar-discount").classList.add("active");
        }

        if (path.includes("/admin/users/")) {
            document.getElementById("sidebar-users").classList.add("active");
        }

        if (path.includes("/admin/staffs/")) {
        document.getElementById("sidebar-staffs").classList.add("active");
        }

        if (path.includes("/admin/activities")) {
        document.getElementById("sidebar-activity").classList.add("active");
        }

        if (path.includes("/admin/warehouses")) {
        document.getElementById("sidebar-warehouses").classList.add("active");
        }

        if (path.includes("/admin/suppliers")) {
        document.getElementById("sidebar-suppliers").classList.add("active");
        }

        if (path.includes("/admin/categories/")) {
            document.getElementById("sidebar-category").classList.add("active");
        }

        //Remove previous active class name
        let previousSideBarActiveItem = document.getElementsByClassName('sidebar-item active')[0].classList.remove("active")
        //Get list of sidebar link
        let sidebarItem = document.getElementsByClassName("sidebar-link");
        for (const element of sidebarItem) {
            //Check href of current element with current path
            if (element.href == path) {
                //Add active class into match path
                element.parentElement.classList.add("active");
            }
        }
    </script>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src=" {{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>
</body>

</html>
