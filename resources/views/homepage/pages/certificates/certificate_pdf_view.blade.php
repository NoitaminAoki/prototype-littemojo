<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500;600;700;900&display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Gelasio:wght@400;500;600&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{url('/page_dist/css/bootstrap/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('/page_dist/css/bootstrap/bootstrap.min.css') }}"> --}}
    <style>
        html{
            min-height:100%;/* make sure it is at least as tall as the viewport */
            position:relative;
        }
        body{
            margin: 0px;
            height:100%; /* force the BODY element to match the height of the HTML element */
        }
        
        
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 300;
            src: url("{{url('/fonts/Montserrat-Light.ttf')}}") format('truetype');
        }
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 500;
            src: url("{{url('/fonts/Montserrat-Medium.ttf')}}") format('truetype');
        }
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            src: url("{{url('/fonts/Montserrat-Bold.ttf')}}") format('truetype');
        }
        @font-face {
            font-family: 'Gelasio';
            font-style: normal;
            font-weight: 600;
            src: url("{{url('/fonts/Gelasio-SemiBold.ttf')}}") format('truetype');
        }
        @font-face {
            font-family: 'Gelasio';
            font-style: normal;
            font-weight: 700;
            src: url("{{url('/fonts/Gelasio-Bold.ttf')}}") format('truetype');
        }
        
        .font-main {
            font-family: 'Montserrat';
        }
        
        .font-footer {
            font-family: 'Gelasio';
        }
        
        #cloud-container{
            position:absolute;
            background-color: #9e9e9e;
            top:0;
            bottom:0;
            left:0;
            right:0;
            overflow:hidden;
            z-index:-1; /* Remove this line if it's not going to be a background! */
        }
        
        .content {
            height:100%;
            width:100%;
            background-image: url("{{url('page_dist/img/certificates/background.png')}}");
            background-color: #ffffff;
            background-size: cover;
        }
        
        .box-content {
            padding: 40px 39px;
        }
        
        .content-body {
            position: relative;
            height: 100%;
            overflow: auto;
        }
        
        .content-img {
            position: absolute;
            top: 2.5rem;
            right: 80px;
            padding: 0;
        }
        
        .content-footer {
            position: absolute;
            top: 40rem;
            left: 2rem;
            width: 360px;
        }
        
        .text-corporation {
            position: absolute;
            top: 4rem;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            text-align: center;
            font-size: 20px;
            letter-spacing: .1rem;
            color: rgb(69,69,69);
            
        }
        
        .text-certificate {
            position: absolute;
            top: 8.5rem;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            text-align: center;
            color: rgb(69,69,69);
            font-size: 2.5rem;
            letter-spacing: .3rem;
        }
        
        .text-certificate-sub {
            position: absolute;
            top: 12.5rem;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            text-align: center;
            color: rgb(69,69,69);
            font-size: 22px;
        }
        
        .text-single-1 {
            position: absolute;
            top: 17.8rem;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            text-align: center;
            font-size: 17px;
            color: rgb(69,69,69);
        }
        
        .text-name {
            width: 610px;
            position: absolute;
            top: 19.5rem;
            left: 50%;
            right: 0;
            margin-left: -305px;
            margin-right: auto;
            /* width: fit-content; */
            text-align: center;
            color: rgb(69,69,69);
            border-bottom: 2.2px solid rgb(255, 98, 185);
        }
        
        .text-single-2 {
            position: absolute;
            top: 27rem;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            text-align: center;
            font-size: 17px;
            color: rgb(69,69,69);
        }
        
        .text-single-3 {
            position: absolute;
            top: 29.5rem;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            text-align: center;
            font-weight: 500;
            font-size: 19px;
            color: rgb(69,69,69);
        }
        
        .text-date {
            width: 170px;
            position: absolute;
            top: 36.5rem;
            left: 50%;
            right: 0;
            margin-left: -85px;
            margin-right: auto;
            /* width: fit-content; */
            text-align: center;
            font-size: 20px;
            padding: .2rem 0;
            color: rgb(69,69,69);
            border-bottom: 2.2px solid rgb(128, 83, 147);
        }
        
        .text-date-sub {
            position: absolute;
            top: 39.3rem;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            text-align: center;
            color: rgb(69,69,69);
            font-size: 20px;
        }
        
        
        .text-footer {
            font-size: 12px;
            font-weight: 600;
            color: #989898;
        }
        
        .text-footer-sub {
            font-size: 11px;
            font-weight: 500;
            color: #989898;
            margin-bottom: .5rem;
        }
        
        @page {
            margin: 0px;
            size: A4 landscape;
        }
    </style>
</head>
<body>
    <div id="cloud-container">
        <div class="content">
            <div class="w-100 h-100 box-content">
                <div class="content-body">
                    <div class="content-img">
                        <img src="{{url($course->corporation->path_thumbnail)}}" alt="{{$course->corporation->name}}" title="{{$course->corporation->name}}">
                    </div>
                    <h5 class="font-main text-corporation font-weight-normal">{{env('APP_NAME_CERTIFICATE')}}</h5>
                    <h2 class="font-main text-certificate font-weight-bold">CERTIFICATE</h2>
                    <h5 class="font-main text-certificate-sub font-weight-normal">OF ACHIEVEMENT</h5>
                    <span class="font-main text-single-1 font-weight-bold d-block">THIS CERTIFICATE IS AWARDED TO</span>
                    <h2 id="text_name" class="font-main text-name font-weight-bold text-uppercase" style="font-size: {{$font_size}}px">{{$username}}</h2>
                    <span class="font-main text-single-2 font-weight-light d-block">has successfully completed</span>
                    <span class="font-main text-single-3 d-block">{{$course->title}}</span>
                    <h5 class="font-main text-date">{{ date('M d, Y') }}</h5>
                    <h5 class="font-main text-date-sub font-weight-normal">DATE</h5>
                    {{--  --}}
                    <div class="content-footer">
                        <span class="font-footer text-footer text-left d-block">Verify at {{env('APP_URL_PROD')}}/verify/{{$generated_hash}}</span>
                        <p class="text-footer-sub text-left">{{config('app.name')}} has confirmed the identity of this individual and their participation in the course.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>