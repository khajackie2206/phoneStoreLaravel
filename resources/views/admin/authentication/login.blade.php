<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset('images/allo.png')}}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>Đăng nhập</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    @include('sweetalert::alert')
    <main class="d-flex w-100">


        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Xin chào bạn</h1>
                            <p class="lead">
                                Đăng nhập để sử dụng hệ thống
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="Charles Hall"
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    @if (count($errors) > 0)
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="text-danger"> {{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if (session('status'))
                                        <ul style="margin-top:10px; ">
                                            <li class="text-danger"> {{ session('status') }}</li>
                                        </ul>
                                    @endif
                                    <form action="/admin/login" method="post">
                                        {{ csrf_field() }}
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                placeholder="Nhập tên đăng nhập" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                placeholder="Nhập password" />

                                        </div>

                                        <div class="text-center mt-3">

                                            <button type="submit" class="btn btn-lg btn-primary">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
