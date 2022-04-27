<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="ti-face-smile"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="ti-dashboard"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
   
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.slider') }}">
            <i class="ti-layout-slider-alt"></i>
            <span>Slider</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.banner') }}">
            <i class="ti-view-list-alt"></i>
            <span>Banner</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.category') }}">
            <i class="ti-layout-list-thumb-alt"></i>
            <span>Category</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.product') }}">
            <i class="ti-layout-list-post"></i>
            <span>Product</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.post') }}">
            <i class="ti-layout-list-post"></i>
            <span>Post</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.order') }}">
            <i class="ti-layout-list-post"></i>
            <span>Order</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.coupon') }}">
            <i class="ti-layout-list-post"></i>
            <span>Coupon</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.delivery') }}">
            <i class="ti-layout-list-post"></i>
            <span>Delivery</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.comment') }}">
            <i class="ti-layout-list-post"></i>
            <span>Comment</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('contact.index') }}">
            <i class="ti-layout-list-post"></i>
            <span>Contact</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.user') }}">
            <i class="ti-user"></i>
            <span>User</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('list.role') }}">
            <i class="ti-unlock"></i>
            <span>Role</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('permission.add') }}">
            <i class="ti-layout-slider-alt"></i>
            <span>Thêm dữ liệu cho bảng Permission</span>
        </a>
    </li>
  
    
    



</ul>