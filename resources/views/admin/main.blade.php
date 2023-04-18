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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
    <script src="{{ asset('Jquery/jquery-3.6.4.min.js') }}" rel="stylesheet"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('canvas-js/canvasjs.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    {{-- <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> --}}
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
    <script>
        jQuery(document).ready(function($) {
        $("#startDate").flatpickr({
           dateFormat: "Y-m-d"
        });
        });
    </script>
    <script>
            jQuery(document).ready(function($) {
                $("#endDate").flatpickr({

                   dateFormat: "Y-m-d"
                });
                });
        </script>
    <script>
        jQuery(document).ready(function($) {
            $("#discountPicker").flatpickr({
               enableTime: true,
               mode: "range",
               dateFormat: "Y-m-d H:i"
            });
            });
    </script>

    <script>


   $('#btn-filter').click(function() {
    var _token = $('input[name="_token"]').val();
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();

    if (startDate == '') {
        document.getElementById("start_date_alert").innerHTML="Vui lòng chọn ngày bắt đầu" ;
        return;
    } else {
        document.getElementById("start_date_alert").innerHTML="" ;
    }

    if (endDate == '') {
        document.getElementById("end_date_alert").innerHTML="Vui lòng chọn ngày kết thúc" ;
        return;
    } else {
        document.getElementById("end_date_alert").innerHTML="" ;
    }

    //start Date must be less than end Date
    if (startDate > endDate) {
        document.getElementById("end_date_alert").innerHTML="Ngày kết thúc phải lớn hơn ngày bắt đầu" ;
        return;
    } else {
        document.getElementById("end_date_alert").innerHTML="" ;
    }

    $.ajax({
        url: "/admin/filter-revenue",
        method: "POST",
        dataType: "JSON",
        data: {
            startDate: startDate,
            endDate: endDate,
            _token: _token
        },
        success: function(data) {
            console.log(data['profits']['labels']);
            updateChart(data);
        }
    });
 });

$('.time-filter').change(function() {
    var time = $(this).val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: "{{url('/admin/filter-time')}}",
        method: "POST",
        dataType: "JSON",
        data: {
            time: time,
            _token: _token
        },
        success: function(data) {
            console.log(data['profits']['labels']);
            updateChart(data);
        }
    });
});


    </script>
    <script>
 function updateChart(data) {
    console.log(data);
        chart.data.labels = data['profits']['labels'];
        chart.data.datasets[0].data = data['revenues']['data'];
        chart.data.datasets[1].data = data['profits']['data'];
        chart.update(); // cập nhật biểu đồ
    }
    </script>
</body>

</html>
