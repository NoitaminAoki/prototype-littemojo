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
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{\Request::is('admin/catalog*') || \Request::is('admin/catalog_topic*') || \Request::is('admin/level*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/catalog')}}" class="nav-link {{\Request::is('admin/catalog*') && !\Request::is('admin/catalog_topic*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Catalog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/catalog_topic')}}" class="nav-link {{\Request::is('admin/catalog_topic*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Catalog Topic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/level')}}" class="nav-link {{\Request::is('admin/level*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Level</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>