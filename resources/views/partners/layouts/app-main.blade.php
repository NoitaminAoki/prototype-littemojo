<!DOCTYPE html>
<!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    @include('partners.layouts.css')
    @yield('css')
    <style>
        input[type="file"] {
            height: calc(2.25rem + 8px);
        }
    </style>
    {{-- @livewireStyles --}}

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        
        <!-- Navbar -->
        @include('partners.layouts.navbar')
        <!-- /.navbar -->
        
        <!-- Main Sidebar Container -->
        @include('partners.layouts.sidebar')
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('Page-Header')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('breadcrumbs')
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    {{ $slot }}
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        <!-- Control Sidebar -->
        <!-- not used -->
        <!-- /.control-sidebar -->
        
        <!-- Main Footer -->
        <footer class="main-footer text-sm">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Prototype Design
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2020-{{Date('Y')}} <a href="https://adminlte.io">LittleMojo</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    
    <!-- REQUIRED SCRIPTS -->
    @stack('script-top')
    @include('partners.layouts.scripts')
    @livewireScripts
    @stack('script')
    {{-- @yield('script') --}}
</body>
</html>
