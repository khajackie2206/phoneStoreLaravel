@extends('index')
@section('content')
<!-- Header Area End Here -->
<!-- Li's Breadcrumb Area End Here -->
<!--Shopping Cart Area Strat-->
<body>
    <div class="vh-100 d-flex justify-content-center align-items-center" style="margin-bottom: 30px;">
        <div class="col-md-4">
            <div class="border border-3 border-success"></div>
            <div class="card  bg-white shadow p-5">
                <div class="mb-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                        fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                </div>
                <div class="text-center">
                    <h1>Cảm ơn quý khách !</h1>
                    <p>Chúng tôi đã gởi email xác nhận đơn hàng, vui lòng kiểm tra email </p>
                    <button class="btn btn-outline-success"><a href="/">Trở về mua hàng</a></button>
                </div>
            </div>
        </div>
    </div>
</body>

<!--Shopping Cart Area End-->
@endsection
