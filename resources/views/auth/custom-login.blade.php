<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LitteMojo | Log in (Customer)</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        input:focus + .input-group-append .input-group-transparent {
            border-color: #80BDFF;
        }
        .custom-info-box-text {
            display: block;
            white-space: pre-wrap !important;
        }
        .custom-info-box-icon {
            width: 35px !important;
        }
    </style>
</head>
<body class="hold-transition login-page">
    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif
    @error('email')
    <div class="login-box">
        <div class="info-box mb-3 bg-pink">
            <span class="info-box-icon custom-info-box-icon"><small><i class="fas fa-exclamation-circle"></i></small></span>
            
            <div class="info-box-content w-100">
                <p class="info-box-text custom-info-box-text text-sm mb-0">We don't recognize that username or password. You can try again or Sign Up</p>
                
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    @enderror
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-orange">
            <div class="card-header text-center">
                <a href="{{ route('home.index') }}" class="h1"><b>Little</b>Mojo</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        @if (env('APP_ENV') === 'local')
                        <input type="email" name="email" class="form-control" value="sanchez77rodriguez@gmail.com" placeholder="Email">
                        @else
                        <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Email">
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        @if (env('APP_ENV') === 'local')
                        <input type="password" name="password" value="gakadapassword" class="form-control border-right-0 pr-0" placeholder="Password">
                        @else
                        <input type="password" name="password" class="form-control border-right-0 pr-0" placeholder="Password">
                        @endif
                        <div class="input-group-append">
                            <div class="input-group-text input-group-transparent bg-transparent">
                                <span class="fas fa-eye icon-eye" style="cursor: pointer"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-warning btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                
                <div class="col-12 mt-3 mb-4">
                    <hr>
                </div>
                <!-- /.social-auth-links -->
                
                <p class="mb-1">
                    <a href="{{ url('/forgot-password') }}" class="text-sm">
                        Forgot password?
                    </a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center text-sm">Register for free</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    
    <script>
        $('.icon-eye').on('mousedown', function() {
            let input = $(this).parents('.input-group').find('input[name="password"]');
            input.attr('type', 'text');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        }).on('mouseup', function() {
            let input = $(this).parents('.input-group').find('input[name="password"]');
            input.attr('type', 'password');
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        });
    </script>
</body>
</html>