<div class="col-md-3 admin-sidebar">
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>

        <ul class="list-unstyled">
            <li class="active">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Products</li>
            <li>
                <a href="{{ route('products.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Add Product</span>
                </a>
            </li>
            <li>
                <a href="{{ route('products.admin') }}">
                    <i class="fas fa-list"></i>
                    <span>All Products</span>
                </a>
            </li>

            <li class="menu-header">Finance</li>
            <li>
                <a href="{{ route('currency.index') }}">
                    <i class="fas fa-money-bill"></i>
                    <span>Currency Settings</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('coupon.index') }}">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Coupons</span>
                </a>
            </li> --}}

            <li class="menu-header">System</li>
            <li>
                <a href="{{ route('admin.logs') }}">
                    <i class="fas fa-history"></i>
                    <span>System Logs</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    .admin-dashboard {
        padding: 20px;
    }

    .admin-sidebar {
        background: #2c3e50;
        min-height: 100vh;
        color: #fff;
    }

    .sidebar-menu {
        padding: 20px 0;
    }

    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid #34495e;
    }

    .sidebar-menu ul li {
        padding: 10px 20px;
    }

    .sidebar-menu ul li a {
        color: #fff;
        text-decoration: none;
    }

    .sidebar-menu ul li.active {
        background: #34495e;
    }

    .menu-header {
        font-size: 12px;
        text-transform: uppercase;
        padding: 10px 20px;
        color: #95a5a6;
    }

    .stats-card {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .stats-icon {
        float: left;
        font-size: 40px;
        color: #3498db;
        margin-right: 20px;
    }

    .stats-info h4 {
        margin: 0;
        font-size: 16px;
        color: #7f8c8d;
    }

    .stats-info p {
        margin: 5px 0 0;
        font-size: 24px;
        font-weight: bold;
    }
</style>

<style>
    .pagination-wrapper .pagination {
        margin: 0 !important;
        border-radius: 8px !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
    }

    .pagination-wrapper .page-item .page-link {
        padding: 0.75rem 1.25rem !important;
        font-weight: 500 !important;
        color: #6c757d !important;
        border: none !important;
        transition: all 0.3s ease !important;
    }

    .pagination-wrapper .page-item.active .page-link {
        background-color: #4e73df !important;
        color: white !important;
    }

    .pagination-wrapper .page-item .page-link:hover {
        background-color: #eaecf4 !important;
        color: #4e73df !important;
    }

    .pagination-wrapper .page-item:first-child .page-link {
        border-top-left-radius: 8px !important;
        border-bottom-left-radius: 8px !important;
    }

    .pagination-wrapper .page-item:last-child .page-link {
        border-top-right-radius: 8px !important;
        border-bottom-right-radius: 8px !important;
    }
</style>
