<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">

        @if(session('user')->role == 1)
        <a class="sidebar-brand" href="/admin/home">
            <span class="align-middle">Dashboard Admin</span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Quản lý sản phẩm
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="/admin/home">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
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
                    <i class="align-middle" data-feather="menu"></i> <span class="align-middle">Danh mục</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Bài viết</span>
                </a>
            </li>
            <li class="sidebar-item" id="sidebar-discount">
                <a class="sidebar-link" href="/admin/discount/lists">
                    <i class="align-middle" data-feather="gift"></i> <span class="align-middle">Khuyến mãi</span>
                </a>
            </li>

            <li class="sidebar-item" id="sidebar-banner">
                <a class="sidebar-link" href="/admin/banner/list">
                    <i class="align-middle" data-feather="image"></i> <span class="align-middle">Banner quảng cáo</span>
                </a>
            </li>

            <li class="sidebar-header">
                Quản lý đơn hàng
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

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Doanh thu & lợi
                        nhận</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Doanh số
                        bán</span>
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

            <li class="sidebar-item">
                <a class="sidebar-link" href="/admin/staffs">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Nhân viên</span>
                </a>
            </li>

        </ul>
        @else
        <a class="sidebar-brand" href="/admin/dashboard-staff">
            <span class="align-middle">Dashboard nhân viên</span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Quản lý sản phẩm
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

            <li class="sidebar-item" id="sidebar-banner">
                <a class="sidebar-link" href="/admin/banner/list">
                    <i class="align-middle" data-feather="image"></i> <span class="align-middle">Banner quảng cáo</span>
                </a>
            </li>

            <li class="sidebar-header">
                Quản lý đơn hàng
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

            <li class="sidebar-header">
                Quản lý người dùng
            </li>

            <li class="sidebar-item" id="sidebar-users">
                <a class="sidebar-link" href="/admin/users">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Khách hàng</span>
                </a>
            </li>


        </ul>
        @endif

    </div>
</nav>
