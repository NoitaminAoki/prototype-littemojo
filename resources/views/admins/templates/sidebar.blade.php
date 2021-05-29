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
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{\Request::is('admin/management/catalog*') || \Request::is('admin/management/level*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{\Request::is('admin/management/catalog*') || \Request::is('admin/management/level*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview text-sm ml-3">                        
                        <li class="nav-item">
                            <a href="{{url('admin/management/catalog')}}" class="nav-link {{\Request::is('admin/management/catalog*') && !\Request::is('admin/management/catalog_topic*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Catalog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/management/catalog_topic')}}" class="nav-link {{\Request::is('admin/management/catalog_topic*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Catalog Topic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/management/level')}}" class="nav-link {{\Request::is('admin/management/level*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Level</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{\Request::is('admin/management/user*') || \Request::is('admin/management/partner/verif_course*') || \Request::is('admin/management/partner/verif_partner*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{\Request::is('admin/management/user*') || \Request::is('admin/management/partner/verif_course*') || \Request::is('admin/management/partner/verif_partner*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Manage
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview text-sm ml-3">
                        <li class="nav-item">
                            <a href="{{url('admin/management/blog')}}" class="nav-link {{\Request::is('admin/management/blog*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/management/user')}}" class="nav-link {{\Request::is('admin/management/user*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview {{\Request::is('admin/management/partner/verif_course*') || \Request::is('admin/management/partner/verif_partner*') ? 'menu-open' : ''}}">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Partner
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="{{url('admin/management/partner/verif_course')}}" class="nav-link {{\Request::is('admin/management/partner/verif_course*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Verif Course</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/management/partner/verif_partner')}}" class="nav-link {{\Request::is('admin/management/partner/verif_partner*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Verif Partner </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>