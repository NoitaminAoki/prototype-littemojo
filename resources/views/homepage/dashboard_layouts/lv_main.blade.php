<!DOCTYPE html>
<!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <title>LittleMojo | @yield('title')</title>
    
    @include('homepage.dashboard_layouts.css')
    @yield('css')
    <style>
        .container {
            max-width: 100%;
        }
        .custom-margin-bottom {
            margin-bottom: 3rem;
        }
        @media (max-width: 452px) {
            .custom-margin-bottom {
                margin-bottom: 5rem;
            }
        }
    </style>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">
        
        <!-- Navbar -->
        @include('homepage.dashboard_layouts.navbar')
        <!-- /.navbar -->
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @hasSection ('breadcrumb-navbar')
            <div class="content-header custom-margin-bottom">
            </div>
            @else
            <div class="content-header">
            </div>
            @endif
            {{-- <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> Top Navigation <small>Example 3.0</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Layout</a></li>
                            <li class="breadcrumb-item active">Top Navigation</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid --> --}}
            <!-- /.content-header -->
            
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    {{ $slot }}
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->
        
        @include('homepage.dashboard_layouts.footer')
        
    </div>
    <!-- ./wrapper -->
    
    <!-- REQUIRED SCRIPTS -->
    @stack('script-top')
    @include('homepage.dashboard_layouts.scripts')
    @livewireScripts
    @stack('script')
</body>
</html>
