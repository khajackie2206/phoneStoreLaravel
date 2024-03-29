<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">

        @if(session('user')->role == 1)
        {{-- <div class="user-panel d-flex">
            <div class="image">
                <img src="{{ session('user')->avatar }}" width=50 class="img-xs rounded-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="color: white;">Alexander Pierce</a>
            </div>
        </div> --}}
        <div class="row"
            style="margin-top: 15px;margin-left: 5px; margin-bottom: 10px;padding-bottom: 10px; border-bottom: 0.5px solid #D3D3D3">
            <div class="col-md-3">
                <img src="{{ session('user')->avatar }}" width=45 class="img-xs rounded-circle" alt="User Image">
            </div>
            <div class="col-md-9">
                <a href="#" class="d-block" style="color: white;">{{ session('user')->name }}</a>
                <a href="#" class="d-block" style="color: rgb(212, 233, 82);">QUẢN TRỊ VIÊN</a>
            </div>
        </div>

        <ul class="sidebar-nav" style="margin-top: -15px;">
            <li class="sidebar-header">
                Tác vụ quản lý
            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link" href="/admin/home">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Bảng điều
                        khiển</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-product">
                <a class="sidebar-link" href="/admin/product/list">
                    <i class="align-middle" data-feather="smartphone"></i> <span class="align-middle">Điện
                        thoại</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-brand">
                <a class="sidebar-link" href="/admin/brand/list">
                    <i class="align-middle" data-feather="globe"></i> <span class="align-middle">Thương hiệu</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-category">
                <a class="sidebar-link" href="/admin/categories/list">
                    <i class="align-middle" data-feather="menu"></i> <span class="align-middle">Danh mục</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Bài viết</span>
                </a>
            </li> --}}
            <li class="sidebar-item" id="sidebar-discount">
                <a class="sidebar-link" href="/admin/discount/lists">
                    <i class="align-middle" data-feather="gift"></i> <span class="align-middle">Khuyến mãi</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-banner">
                <a class="sidebar-link" href="/admin/banner/list">
                    <i class="align-middle" data-feather="image"></i> <span class="align-middle">Banner quảng
                        cáo</span>
                </a>
            </li>

            {{-- <li class="sidebar-header" style="margin-top: -10px;">
                Quản lý đơn hàng
            </li> --}}

            <li class="sidebar-item" id="sidebar-order">
                <a class="sidebar-link" href="/admin/order/lists">
                    <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Đơn hàng</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-comments">
                <a class="sidebar-link" href="/admin/comments/lists">
                    <i class="align-middle" data-feather="message-circle"></i> <span class="align-middle">Bình luận &
                        đánh giá</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-warehouses">
                <a class="sidebar-link" href="/admin/warehouses">
                    <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Quản lý nhập kho</span>
                </a>
            </li>
            {{--
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Doanh số
                        bán</span>
                </a>
            </li> --}}
            <li class="sidebar-header" style="margin-top: -10px;">
                Quản lý người dùng
            </li>
            <li class="sidebar-item" id="sidebar-activity">
                <a class="sidebar-link" href="/admin/activities">
                    <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Quản lý truy
                        cập</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-users">
                <a class="sidebar-link" href="/admin/users">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Khách hàng</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-staffs">
                <a class="sidebar-link" href="/admin/staffs">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Nhân viên</span>
                </a>
            </li>
            <li class="sidebar-item" id="sidebar-suppliers">
                <a class="sidebar-link" href="/admin/suppliers">
                    <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Nhà cung cấp</span>
                </a>
            </li>
            <li class="sidebar-item" id="sidebar-feedbacks">
                <a class="sidebar-link" href="/admin/feedback/lists">
                    <i class="align-middle" data-feather="thumbs-up"></i> <span class="align-middle">Phản hồi</span>
                </a>
            </li>

        </ul>
        @else
        <div class="row"
            style="margin-top: 15px;margin-left: 5px; margin-bottom: 10px;padding-bottom: 10px; border-bottom: 0.5px solid #D3D3D3">
            <div class="col-md-3">
                <img src="{{ session('user')->avatar }}" width=45 class="img-xs rounded-circle" alt="User Image">
            </div>
            <div class="col-md-9">
                <a href="#" class="d-block" style="color: white;">{{ session('user')->name }}</a>
                <a href="#" class="d-block" style="color: rgb(212, 233, 82);">NHÂN VIÊN</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Tác vụ quản lý
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="/admin/dashboard-staff">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-product">
                <a class="sidebar-link" href="/admin/product/list">
                    <i class="align-middle" data-feather="smartphone"></i> <span class="align-middle">Điện
                        thoại</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-category">
                <a class="sidebar-link" href="/admin/categories/list">
                    <i class="align-middle" data-feather="menu"></i> <span class="align-middle">Danh mục</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-banner">
                <a class="sidebar-link" href="/admin/banner/list">
                    <i class="align-middle" data-feather="image"></i> <span class="align-middle">Banner quảng
                        cáo</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-order">
                <a class="sidebar-link" href="/admin/order/lists">
                    <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Đơn hàng</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-comments">
                <a class="sidebar-link" href="/admin/comments/lists">
                    <i class="align-middle" data-feather="message-circle"></i> <span class="align-middle">Bình luận &
                        đánh giá</span>
                </a>
            </li>
            <li class="sidebar-item" id="sidebar-warehouses">
                <a class="sidebar-link" href="/admin/warehouses">
                    <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Quản lý nhập kho</span>
                </a>
            </li>

            <li class="sidebar-header">
                Quản lý người dùng
            </li>

            <li class="sidebar-item" id="sidebar-users">
                <a class="sidebar-link" href="/admin/users">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Khách hàng</span>
                </a>
            </li>
            <li class="sidebar-item" id="sidebar-suppliers">
                <a class="sidebar-link" href="/admin/suppliers">
                    <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Nhà cung cấp</span>
                </a>
            </li>
            <li class="sidebar-item" id="sidebar-feedbacks">
                <a class="sidebar-link" href="/admin/feedback/lists">
                    <i class="align-middle" data-feather="thumbs-up"></i> <span class="align-middle">Phản hồi về đơn
                        hàng</span>
                </a>
            </li>
        </ul>
        @endif

    </div>
</nav>
