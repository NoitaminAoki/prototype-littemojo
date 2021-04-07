@extends('homepage.layouts.main')
@section('font-awesome', 'new')
@section('top-css')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection
@section('css')
<style>
    .sf-arrows .sf-with-ul:after {
        content: none;
    }
    .sf-arrows .sf-with-ul {
        padding-right: 8px;
    }
    
    .about-content {
        padding: 80px 0 !important;
    }
    
    .single-popular-carusel .details h4:hover {
        color: #ffffff !important;
    }
    .single-popular-carusel .meta {
        padding: 0 !important;
    }
    .custom-div {
        position: absolute;
        background-image: linear-gradient(135deg, #1c96de, rgb(0 69 95));
        transform: skewY(-10deg);
        -webkit-transform: skewY(-10deg);
        height: 100%;
        width: 100%;
        top: 190px;
    }
    .custom-div-2 {
        position: absolute;
        background-color: rgb(111 111 111);
        transform: skewY(70deg);
        -webkit-transform: skewY(70deg);
        height: 100%;
        width: 54%;
        top: 190px;
    }
    .thumbnail-div {
        position: absolute;
        border: 1px solid rgb(225, 225, 225);
        border-radius: 3px;
        z-index: 1;
        background-color: rgb(255, 255, 255);
        width: 72px;
        height: 72px;
        padding: 8px;
        /* top: 146px; */
        top: 154px;
        left: 17px;
    }
    .thumbnail-div-img {
        width: 100%;
        height: 100%;
        background-size: contain;
        background-position: center center;
        background-repeat: no-repeat;
    }
    .sub-custom-div h4 {
        font-size: 1.25rem;
        line-height: 1.5rem;
        font-weight: normal;
        font-family: OpenSans, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        margin-bottom: 15px !important;
    }
    .sub-custom-div h6 {
        font-size: 0.875rem;
        line-height: 1.5rem;
        font-weight: normal;
        font-family: OpenSans, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .sub-custom-div {
        position: relative;
        z-index: 1;
        padding: 0.75rem 1.0rem;
        background-color: transparent !important;
        color: rgb(255, 255, 255);
    }
    .custom-bottom-div {
        width: 100%;
        position: absolute;
        bottom: 4px;
        padding: 0.75rem 1.0rem;
        /* background-color: rgba(255, 255, 255, 0.493); */
        border-color: rgb(189, 189, 189);
        color: rgb(255, 255, 255);
    }
    
    .top-banner-image {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        width: 50%;
        background-color: transparent;
        background-position: 100%;
        background-repeat: no-repeat;
        background-size: cover;
    }
    
    .overlay-bg-color {
        background-color: rgb(27 29 81 / 43%);
    }
    
    .overlay-transform-1 {
        background-color: rgb(36 44 76);
        transform: skewX(-35deg);
        transform-origin: 100% -185%;
    }
    
    .overlay-transform-2 {
        background-color: rgb(34 49 113);
        transform: skewX(-24deg);
        transform-origin: 100% -370%;
    }
    
    .title-content {
        border-radius: 0.7rem;
        /* background-color: #0000006b; */
        padding: 10px 0;
    }
    
    
    .custom-info-box {
        min-height: 60px !important;
    }
    .custom-info-box-content {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-pack: center;
        justify-content: center;
        line-height: 120%;
    }
    .custom-content-top {
        justify-content: end !important;
    }
    .custom-info-box-icon {
        -webkit-box-align: center;
        -webkit-box-pack: center;
        width: 44px !important;
        height: 44px !important;
        border: 2px solid rgb(225, 225, 225);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
    }
    .custom-info-box-text {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: pre-wrap;
    }
    .custom-icon-top {
        align-items: end;
        padding-top: 3px;
    }
    a.custom-text-white:hover {
        text-decoration: underline !important;
    }
    .custom-header-text-lesson {
        font-size: 3.75rem;
        line-height: 4.5rem;
        font-weight: normal;
        font-family: OpenSans-Light, OpenSans, Arial, sans-serif;
    }
    .custom-headline-text-lesson {
        font-family: OpenSans,Arial,sans-serif;
        font-size: 20px;
        line-height: 24px;
    }
    .custom-icon-sm {
        width: 40px !important;
        height: 40px !important;
    }
    
    /* Imported Admin LTE CSS */
    .info-box {
        ox-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
        border-radius: .25rem;
        background: #fff;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 1rem;
        min-height: 80px;
        padding: .5rem;
        position: relative;
        width: 100%;
    }
    .info-box .info-box-content {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-pack: center;
        justify-content: center;
        line-height: 120%;
        -ms-flex: 1;
        flex: 1;
        padding: 0 10px;
    }
    
    .info-box-text h5 {
        font-size: 1.25rem;
        line-height: 1.5rem;
        font-weight: bold;
        font-family: OpenSans-Bold, OpenSans, Arial, sans-serif;
    }
    
    /* End Imported Admin LTE CSS */
    
    
    /* Imported Custom Admin LTE CSS */
    
    .custom-bg-gradient-green {
        color: white;
        background-image: linear-gradient(to right, rgb(9, 227, 56, 1), rgba(9, 209, 227,1));
    }
    
    /* End Imported Custom Admin LTE CSS */
    
    .headline-4-text {
        font-size: 24px;
        line-height: 30px;
        font-family: OpenSans,Arial,sans-serif !important;
    }
    
    .cust-container {
        margin-left: auto;
        margin-right: auto;
        padding-left: 12px;
        padding-right: 12px;
    }
    
    .headline-desc-course {
        font-size: 0.875rem;
        line-height: 1.5rem;
        font-weight: bold;
        font-family: OpenSans, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    .skill-content {
        border-radius: 1.875rem;
        line-height: 1.5rem;
        font-size: 0.875rem;
        background-color: #EBECED;
        color: #000000;
        min-width: 60px;
    }
    
    .content-offer-by {
        font-size: 14px;
        line-height: 21px;
        font-family: OpenSans,Arial,sans-serif;
        color: #373a3c;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    .text-enroll {
        font-size: 1rem;
        line-height: 1rem;
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
    .text-rating {
        font-size: 14px;
        line-height: 19px;
        font-weight: 700;
        font-family: 'Open Sans';
    }
    
    .text-enrolled {
        font-size: 16px;
        font-weight: 400;
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
    .btn-enroll-course {
        min-height: 71px;
    }
    
    .pt-4rem {
        padding-top: 4rem !important;
    }
    
    .text-font-family {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
    .paragraph-text {
        font-size: 14px;
        line-height: 21px;
        font-weight: 400;
        font-family: 'Open Sans', Arial, sans-serif;
    }
    
    .progress-table {
        min-width: 0px;
    }
    
    .custom-bg-gray {
        background-color: #f9f9ff;
    }
    
    .custom-text-orange {
        color: #f7631b !important;
    }
    
    /* Important Daterangepicker */
    
    .daterangepicker select {
        display: unset !important;    
    }
    
    .daterangepicker {
        color: #000000;
    }
    /* End Important Daterangepicker */
    
    .single-popular-carusel {
        overflow: hidden;
    }

    .progress-table .visit {
        width: 85%;
    }
    
</style>
@endsection

@section('content')
<!-- start banner Area -->
<section class="relative" id="home">	
    <div class="top-banner-image" style="background-image: url({{asset('page_dist/img/campus-wallpaper-course.jpg')}})"></div>
    <div class="overlay overlay-bg-color"></div>
    <div class="overlay overlay-transform-1"></div>
    <div class="overlay overlay-transform-2"></div>
    <div class="container">				
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <div class="title-content">
                    <h1 class="text-white">
                        {{$course->title}}	
                    </h1>	
                    <p class="text-white link-nav">
                        <a href="index.html">Home </a>  
                        <span class="lnr lnr-arrow-right"></span>  
                        <a href="courses.html"> {{$course->catalog_title}}</a>
                        <span class="lnr lnr-arrow-right"></span>  
                        <a href="courses.html"> {{$course->catalog_topic_title}}</a>
                    </p>
                </div>
            </div>	
        </div>
    </div>
</section>
<!-- End banner Area -->	

<!-- Start course-details Area -->
<section class="course-details-area pt-80 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 left-contents border-top pt-4">
                <div class="main-image border-bottom">
                    <div class="col-lg-12">
                        <h4 class="headline-4-text font-weight-normal mb-2">Course Outline</h4>
                        <div class="w-100">
                            <div class="progress-table-wrap">
                                <div class="progress-table">
                                    <div class="table-head border border-bottom-0">
                                        <div class="serial">#</div>
                                        <div class="visit">Lessons</div>
                                    </div>
                                    @foreach($course->lessons as $key => $lesson)
                                    <div class="table-row custom-bg-gray border-left border-right">
                                        <div class="serial">{{$key+1}}</div>
                                        <div class="visit">{{$lesson->title}}</div>
                                    </div>
                                    @endforeach
                                    <div class="table-head border border-top-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4rem"></div>
                    </div>
                </div>
                <div class="col-lg-12 pt-4rem">
                    <h4 class="headline-4-text font-weight-normal mb-2">Offered By</h4>
                    <div class="py-3 d-flex">
                        <div class="mr-4">
                            <img src="http://localhost:8000/uploaded_files/corporation/88224769-702a-309b-5682-4e61vf3095t4/_thumbnail.png" alt="Google" title="Google">
                        </div>
                        <div>
                            <h4 class="headline-4-text font-weight-bold">Google</h4>
                            <p class="content-offer-by  mt-2">Google Career Certificates are part of Grow with Google, an initiative that draws on Google's 20-year history of building products, platforms, and services that help people and businesses grow. Through programs like these, we aim to help everyone– those who make up the workforce of today and the students who will drive the workforce of tomorrow – access the best of Google’s training and tools to grow their skills, careers, and businesses.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 right-contents border-top pt-4">
                <div class="event-details-area">
                    <div class="event-details-right">
                        <div class="single-event-details">
                            <h4>Details</h4>
                            <ul class="mt-10">
                                <li class="justify-content-between d-flex">
                                    <span>Offered By</span>
                                    <span class="or">{{$course->corporation->name}}</span>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <span>Duration</span>
                                    @if ($course->duration == 'week')
                                    <span> 7 days / 1 week </span>
                                    @elseif($course->duration == 'month')
                                    <span> 30 days / 1 month </span>
                                    @endif
                                </li>
                                <li class="justify-content-between d-flex">
                                    <span>Level</span>
                                    <span>{{$course->level_name}}</span>
                                </li>														
                            </ul>
                        </div>	
                    </div>													
                </div>
                <div class="right-contents">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" style="cursor: default;" href="javascript:void(0);">
                                <p>Course Price </p>
                                <span>{{number_format($course->price, 0, ',', '.')}} IDR</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex mb-2" style="cursor: default;" href="javascript:void(0);">
                                <p>Start Date </p>
                            </a>
                            <input type="text" name="" id="" class="form-control datetimepicker">
                        </li>
                    </ul>
                    <a href="#" class="primary-btn text-uppercase">Enroll the course</a>
                </div>
            </div>
        </div>
    </div>	
</section>
<!-- End course-details Area -->

<!-- Start popular-course Area -->
<section class="popular-course-area section-gap custom-bg-gray">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Other Course from <a href="#" class="custom-text-orange">{{$course->corporation->name}}</a></h1>
                    <p>There is a moment in the life of any aspiring.</p>
                </div>
            </div>
        </div>						
        <div class="row">
            <div class="active-popular-carusel">
                @foreach ($courses->popular_courses as $popular_course)
                <div class="single-popular-carusel relative">
                    <a href="{{ route('home.detail.course', ['title'=>Str::slug($popular_course->title)]) }}">
                        <div class="thumb-wrap relative">
                            <div class="thumb relative">
                                <div class="overlay overlay-bg"></div>	
                                <img class="img-fluid" src="{{ asset('page_dist/img/p'.rand(1, 4).'.jpg')}}" alt="">
                            </div>
                            <div class="meta d-flex justify-content-between">
                                <br>
                                {{-- <p><span class="lnr lnr-users"></span> {{rand(100, 3000)}} <span class="lnr lnr-bubble"></span>{{rand(10, 250)}}</p> --}}
                                {{-- <h4>{{$popular_course->price}}</h4> --}}
                            </div>									
                        </div>
                        <div class="details" style="min-height: 230px">
                            <div>
                                <div class="custom-div-2">
                                </div>
                                <div class="custom-div">
                                </div>
                                <div class="thumbnail-div">
                                    <div class="thumbnail-div-img" style="background-image: url({{ asset($popular_course->corporation->path_thumbnail) }})"></div>
                                </div>
                                <div class="sub-custom-div mt-1">
                                    <h4 class="text-white">
                                        {{$popular_course->title}}
                                    </h4>
                                    <h6 class="text-white">{{$popular_course->corporation->name}}</h6>
                                </div>
                                <div class="custom-bottom-div">
                                    {{-- <div class="meta d-flex justify-content-between">
                                    <p><span class="lnr lnr-users"></span> {{rand(100, 3000)}} <span class="lnr lnr-bubble"></span>{{rand(10, 250)}}</p>
                                    </div> --}}
                                    <small class="text-uppercase text-light">{{$popular_course->catalog->name}}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach						
            </div>
        </div>
    </div>	
</section>
<!-- End popular-course Area -->				
@endsection
@section('script')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.datetimepicker').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: true,
            minDate: moment().format('MMMM YYYY HH:mm DD'),
            maxDate: moment().add(1, 'years').format('MMMM YYYY HH:mm DD'),
            locale: {
                format: 'MMMM YYYY HH:mm DD'
            }
        });
    })
</script>
@endsection