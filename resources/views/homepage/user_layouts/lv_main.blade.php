<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>{{env("APP_NAME")}} @yield('title')</title>
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!--  CSS ============================================= -->
    <style>
        .sf-arrows .sf-with-ul:after {
            content: none !important;
        }
        .sf-arrows .sf-with-ul {
            padding-right: 8px !important;
        }
        .single-popular-carusel {
            display: none;
        }
        .owl-item > .single-popular-carusel {
            display: block;
        }
    </style>
    @yield('top-css')
    @include('homepage.user_layouts.lv_css')
    @yield('css')
    
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>	
    @include('homepage.user_layouts.lv_header')
    <!-- #header -->
    
    {{ $slot }}
    
    @stack('script-top')
    @include('homepage.layouts.footer')
    @include('homepage.layouts.scripts')
    @livewireScripts
    @stack('script')
</body>
</html>