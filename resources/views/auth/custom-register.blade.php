<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LitteMojo | Sign Up (Customer)</title>
    
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
                <p class="info-box-text custom-info-box-text text-sm mb-0">{{$message}}</p>
                
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
                <p class="login-box-msg">Learn on your own time from top universities and businesses.</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    
                    <div class="mt-2">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="off" />
                    </div>
                    
                    <div class="mt-2">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control border-right-0 pr-0" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text input-group-transparent bg-transparent">
                                    <span class="fas fa-eye icon-eye" style="cursor: pointer"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control border-right-0 pr-0" placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text input-group-transparent bg-transparent">
                                    <span class="fas fa-eye icon-eye" style="cursor: pointer"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-jet-validation-errors class="mb-4" />
                    <div class="row mt-4">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-warning btn-block">Sign Up</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                
                <div class="col-12 mt-3 mb-4">
                    <hr>
                </div>
                <!-- /.social-auth-links -->
                
                <p class="mb-1">
                    Already Registered? <a href="{{ route('login') }}" class="text-sm">Sign In</a>
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
            let input = $(this).parents('.input-group').find('input');
            input.attr('type', 'text');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        }).on('mouseup', function() {
            let input = $(this).parents('.input-group').find('input');
            input.attr('type', 'password');
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        });
    </script>
</body>
</html>