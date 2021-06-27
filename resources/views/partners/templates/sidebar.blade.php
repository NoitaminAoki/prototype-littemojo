<aside class="main-sidebar sidebar-light-teal elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link navbar-white">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Management</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('partner')->user()->name }}</a>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('partner.dashboard') }}" class="nav-link {{ (Request::routeIs('partner.dashboard'))? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">MANAGE</li>
                <li class="nav-item">
                    <a href="{{ route('partner.manage.course.index') }}" class="nav-link {{ (Request::routeIs('partner.manage.course') || Request::routeIs('partner.manage.course.*'))? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Courses</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('partner.manage.corporation.index') }}" class="nav-link {{ (Request::routeIs('partner.manage.corporation') || Request::routeIs('partner.manage.corporation.*'))? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Profile Corporation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('partner/management/transaction')}}" class="nav-link {{\Request::is('partner/management/transaction*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Transaction</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('partner.manage.withdrawal')}}" class="nav-link {{ (Request::routeIs('partner.manage.withdrawal*'))? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Withdrawal</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>