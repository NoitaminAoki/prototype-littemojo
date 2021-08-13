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
    <title>{{config('app.name')}}</title>
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!--  CSS ============================================= -->
    <style>
        .single-popular-carusel {
            display: none;
        }
        .owl-item > .single-popular-carusel {
            display: block;
        }
    </style>
    @yield('top-css')
    @include('homepage.layouts.css')
    @yield('css')
</head>
<body>	
    @include('homepage.layouts.header')
    <!-- #header -->
    
    @yield('content')
    
    @include('homepage.layouts.footer')
    @include('homepage.layouts.scripts')
    @yield('script')
</body>
</html>