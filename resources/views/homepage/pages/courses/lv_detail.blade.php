@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/rating-star.css') }}">
<style>
    .sf-arrows .sf-with-ul:after {
        content: none;
    }
    .sf-arrows .sf-with-ul {
        padding-right: 8px;
    }
    .banner-title {
        font-family: OpenSansBoldOptional,Arial,sans-serif;
        font-size: 34px;
        line-height: 46px;
    }
    .about-banner {
        background: none;
    }
    .header-area {
        /* background-color: #ffffff; */
        height: 65px;
    }
    #header {
        transition: all 0.5s !important;
        background-color: rgba(4,9,30,0.9) !important;
    }
    .banner-gradient-color {
        color: white;
        background-image: linear-gradient(90deg, rgb(66, 133, 244), rgb(52, 168, 83));
    }
    .text-offer-by {
        padding-top: .75rem;
        padding-bottom: .25rem;
        padding-left: 1rem;
        padding-right: 1rem;
        font-size: 1rem;
        line-height: 21px;
    }
    .image-offer-by {
        max-width: 100%;
        max-height: 70px;
    }
    .offer-area {
        padding-left: 8%;
    }
    .chevron-right-avg {
        fill:#FFF;
        height:21px;
        width:16px;
        display:flex;
        margin-left:0.5rem;
        margin-right:0.5rem;
        vertical-align: middle;
        color: rgb(54, 59, 66);
        transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;
        user-select: none;
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
    
    .content-rating-course > .text-rating {
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
    
    .box-left-number {
        display: inline-block;
    }
    
    .title-review {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    
    .box-left-review {
        padding-right: 5rem;
    }
    
    .number-text-review {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-weight: 700;
        font-size: 3rem;
        line-height: 3.75rem !important;
        margin-bottom: 0;
    }
    .number-text-review small {
        font-size: 1.5rem;
        color: #777;
    }
    
    .star-text-review {
        font-size: 1.3rem;
    }
    .star-sub-text-review {
        padding-top: 5px;
        color: #000000;
    }
    
    .custom-bg-orange {
        background-color: #ffac15;
    }
    
    .box-user-review h6 {
        font-size: 1rem;
    }
    
    @media (min-width: 608px){
        .cust-container {
            width: 576px;
        }
    }
    @media (min-width: 824px){
        .cust-container {
            width: 792px;
        }
    }
    @media (min-width: 1040px){
        .cust-container {
            width: 1008px;
        }
    }
    @media (min-width: 1184px){
        .cust-container {
            width: 1152px;
        }
        
    }
    @media (min-width: 1472px) {
        .cust-container {
            width: 1440px;
        }
    }
    .content-box-icon {
        padding-left: 1.5rem;
    }
    @media (max-width: 960px) {
        .banner-gradient-color {
            background-image: linear-gradient(90deg, rgb(66, 133, 244), rgb(52, 168, 141));
        }
    }
    @media (max-width: 992px) {
        .box-left-number {
            display: block;
        }
    }
    @media (max-width: 768px) {
        .content-box-icon {
            margin-top: 2rem;
            padding-left: 15px;
        }
        .banner-gradient-color {
            background-image: linear-gradient(90deg, rgb(66, 133, 244), rgb(52, 131, 168));
        }
        .offer-area {
            border-top: 1px solid #ffffff;
            margin-top: 2rem;
            padding-left: 15px;
        }
        .text-offer-by {
            padding-left: 0;
            padding-bottom: 1rem;
        }
    }
    .content-user-review {
        min-width: 100%;
    }
    @media (min-width: 1184px){
        .content-user-review {
            min-width: unset;
        }
    }
    
    .content-form-review .title-form {
        font-size: 1.25rem;
        margin-bottom: 2rem;
    }
    
    .genric-btn.custom-disable{
        background: #b3b3b9;
        border: 1px solid transparent;
        cursor: not-allowed;
    }
    
</style>
@endsection

<div>
    <section class="header-area banner-gradient-color">
    </section>
    <!-- start banner Area -->
    <section class="banner-area banner-gradient-color relative about-banner" id="home">	
        <div class="px-5 py-4">				
            <div class="row">
                <div class="col-md-6">
                    <ol class="breadcrumb pl-0" style="background-color: transparent">
                        <li class=""><a href="#" class="text-white custom-text-white text-decoration-none font-weight-bold">Browse</a></li>
                        <li class="">
                            <span class="d-block">
                                <svg class="chevron-right-avg" aria-hidden="true" focusable="false" viewBox="0 0 48 48" role="img" aria-labelledby="ChevronRightfea0a322-8175-469f-d034-c9feaa91d4e4 ChevronRightfea0a322-8175-469f-d034-c9feaa91d4e4Desc" xmlns="http://www.w3.org/2000/svg"><polygon transform="translate(23.999500, 24.000000) scale(-1, 1) translate(-23.999500, -24.000000)" points="16 24 30.585 40 31.999 38.586 18.828 24 31.999 9.415 30.585 8" role="presentation"></polygon></svg>
                            </span>
                        </li>
                        <li class=""><a href="#" class="text-white custom-text-white text-decoration-none font-weight-bold">{{$course->catalog_title}}</a></li>
                        <li class="">
                            <span class="d-block">
                                <svg class="chevron-right-avg" aria-hidden="true" focusable="false" viewBox="0 0 48 48" role="img" aria-labelledby="ChevronRightfea0a322-8175-469f-d034-c9feaa91d4e4 ChevronRightfea0a322-8175-469f-d034-c9feaa91d4e4Desc" xmlns="http://www.w3.org/2000/svg"><polygon transform="translate(23.999500, 24.000000) scale(-1, 1) translate(-23.999500, -24.000000)" points="16 24 30.585 40 31.999 38.586 18.828 24 31.999 9.415 30.585 8" role="presentation"></polygon></svg>
                            </span>
                        </li>
                        <li class=""><a href="#" class="text-white custom-text-white text-decoration-none font-weight-bold">{{$course->catalog_topic_title}}</a></li>
                    </ol>
                    <h2 class="font-weight-bold text-light banner-title"> {{$course->title}} </h2>
                    <div class="text-warning content-rating-course mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $courseDetailRating->avg_rating)
                        <span class="fas fa-star checked"></span>
                        @else
                        @if ($i == ceil($courseDetailRating->avg_rating))
                        <span class="fas fa-star-half-alt checked"></span>
                        @else
                        <span class="far fa-star"></span>
                        @endif
                        @endif
                        @endfor
                        <span class="ml-1 text-rating">{{$courseDetailRating->avg_rating}}</span>
                        <span class="ml-1 text-white">{{number_format($courseDetailRating->total, 0)}} rating{{($courseDetailRating->total > 1)? 's' : ''}}</span>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    @auth('web')
                    <a href="{{ route('home.course.enroll', ['title' => Str::slug($course->title)]) }}" class="btn btn-warning btn-lg btn-enroll-course px-4">
                        <span class="text-enroll font-weight-bold text-light">Enroll This Course <br> Starts {{Date('M d')}}</span>
                    </a>
                    @endauth
                    @guest
                    <button class="btn btn-warning btn-lg btn-enroll-course px-4">
                        <span class="text-enroll font-weight-bold text-light">Enroll This Course <br> Starts {{Date('M d')}}</span>
                    </button>
                    @endguest
                    <div class="mt-3 text-enrolled">
                        <span><strong class="font-weight-bold">{{number_format($course->getTotalEnrolled(), 0)}}</strong> Already enrolled</span>
                    </div>
                    
                    <br>
                </div>
                <div class="col-md-6 offer-area">
                    <p class="text-light text-offer-by mb-0">Offered By</p>
                    <img class="image-offer-by" src="{{asset($course->corporation->path_logo)}}" alt="{{$course->corporation->name}}" title="{{$course->corporation->name}}">
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->	
    <!-- Start events-list Area -->
    <section class="events-list-area mt-5 event-page-lists">
        <div class="col-lg-12 border-top pt-3">
            <div class="cust-container">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="headline-4-text font-weight-bold">About this Course</h4>
                        <div class="pr-1 my-4 text-black">
                            {!! $course->description !!}
                        </div>
                        
                        <div class="w-100 px-3 pt-3 border">
                            <h3 class="headline-desc-course text-secondary">WHAT YOU WILL LEARN</h3>
                            <br>
                            <div class="row mt-4">
                                @foreach ($course->experiences as $exp_item)
                                <div class="col-lg-6">
                                    <div class="info-box custom-info-box shadow-none p-0">
                                        <span class="custom-info-box-icon custom-icon-top border-0 text-success"><i class="fas fa-check"></i></span>
                                        
                                        
                                        <div class="info-box-content custom-content-top pl-0">
                                            <span class="custom-info-box-text text-black">{{$exp_item->name}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="w-100 px-3 pt-3 border mt-3">
                            <h3 class="headline-desc-course text-secondary">SKILLS YOU WILL GAIN</h3>
                            <div class="d-flex flex-wrap my-4">
                                @foreach ($course->skills as $skill_item)
                                <div class="skill-content text-center py-1 px-3 mb-2 mr-2">{{$skill_item->skill->name}}</div>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-4 content-box-icon">
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="far fa-clock"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">Duration</h5></span>
                                @if ($course->duration == 'week')
                                <span class="info-box-text"> 7 days / 1 week </span>
                                @elseif($course->duration == 'month')
                                <span class="info-box-text"> 30 days / 1 month </span>
                                @endif
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="fas fa-calendar-check"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">flexible schedule</h5></span>
                                <span class="info-box-text"> Set and maintain flexible deadlines. </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="fas fa-signal"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0"> {{$course->level_name}} </h5></span>
                                <span class="info-box-text">{{$course->level_desc}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="fas fa-tag"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">Price</h5></span>
                                <span class="info-box-text">Rp {{number_format($course->price, 0, ',', '.')}} IDR</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-12 my-5"></div>
                    <div class="col-lg-12">
                        <h4 class="headline-4-text font-weight-bold pl-3">Offered By</h4>
                        <div class="col-md-6 py-3 d-flex">
                            <div class="mr-4">
                                <img src="{{asset($course->corporation->path_thumbnail)}}" alt="{{$course->corporation->name}}" title="{{$course->corporation->name}}">
                            </div>
                            <div>
                                <h4 class="headline-4-text font-weight-bold">{{$course->corporation->name}}</h4>
                                <p class="content-offer-by  mt-2">{{$course->corporation->description}}</p>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    <!-- End events-list Area -->
    
    <!-- Start review Area -->
    <section wire:ignore class="review-area section-gap relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">				
            <div class="row">
                <div class="active-review-carusel">
                    <div class="single-review item">
                        <div class="title justify-content-start d-flex">
                            <a href="#"><h4>Fannie Rowe</h4></a>
                            <div class="star">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                    </div>
                    <div class="single-review item">
                        <div class="title justify-content-start d-flex">
                            <a href="#"><h4>Hulda Sutton</h4></a>
                            <div class="star">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                    </div>
                    <div class="single-review item">
                        <div class="title justify-content-start d-flex">
                            <a href="#"><h4>Fannie Rowe</h4></a>
                            <div class="star">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                    </div>
                    <div class="single-review item">
                        <div class="title justify-content-start d-flex">
                            <a href="#"><h4>Hulda Sutton</h4></a>
                            <div class="star">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                    </div>	
                    <div class="single-review item">
                        <div class="title justify-content-start d-flex">
                            <a href="#"><h4>Fannie Rowe</h4></a>
                            <div class="star">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                    </div>
                    <div class="single-review item">
                        <div class="title justify-content-start d-flex">
                            <a href="#"><h4>Hulda Sutton</h4></a>
                            <div class="star">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                    </div>
                    <div class="single-review item">
                        <img src="{{ asset('page_dist/img/r1.png')}}" alt="">
                        <div class="title justify-content-start d-flex">
                            <a href="#"><h4>Fannie Rowe</h4></a>
                            <div class="star">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                    </div>
                    <div class="single-review item">
                        <div class="title justify-content-start d-flex">
                            <a href="#"><h4>Hulda Sutton</h4></a>
                            <div class="star">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                    </div>																												
                </div>
            </div>
        </div>	
    </section>
    <!-- End review Area -->	
    
    <section class="events-list-area mt-5 event-page-lists">
        <div class="col-lg-12 border-top">
            <div class="cust-container">
                <h4 class="text-center headline-4-text font-weight-bold pt-4rem">Syllabus - What you will learn from this course</h4>
                <div class="text-center text-font-family text-black font-weight-bold">
                    <span>Content Rating</span>
                    <span class="mx-1 fas fa-thumbs-up text-warning"></span>
                    <span class="text-secondary">97%</span>
                    <span>(521,705 ratings)</span>
                </div>
                <div class="row my-4 text-black">
                    @foreach($course->lessons as $key => $lesson)
                    <div class="col-12 mt-3 row">
                        <div class="col-lg-2">
                            <div class="text-center box-left-number">
                                <span>LESSON</span>
                                <br>
                                <span class="custom-header-text-lesson">{{$key+1}}</span>
                            </div>
                        </div>
                        <div class="col-lg-10 border-bottom">
                            <h2 class="font-weight-bold custom-headline-text-lesson mb-3">{{$lesson->title}}</h2>
                            
                            <p class="text-black paragraph-text">{{$lesson->description}}</p>
                            
                            <div class="info-box custom-info-box shadow-none p-0 mb-5">
                                <div class="custom-info-box-content pr-1">
                                    <span class="custom-info-box-icon border-0 custom-icon-sm custom-bg-gradient-green rounded-circle text-white"><i class="fas fa-book"></i></span>
                                </div>
                                
                                <div class="info-box-content text-font-family font-weight-normal">
                                    <span class="info-box-text text-secondary">
                                        {{$lesson->totalVideos()->total}} videos (Total {{$lesson->totalVideos()->duration_as_minute}} min),
                                        {{$lesson->totalbooks()}} readings,
                                        {{$lesson->totalQuizzes()}} quizzes
                                        {{-- @if ($lesson->totalVideos()->total > 0) {{$lesson->totalVideos()->total}} videos (Total {{$lesson->totalVideos()->duration_as_minute}} min){{($lesson->totalbooks() > 0)? ',' : ''}} @endif @if ($lesson->totalbooks() > 0) {{$lesson->totalbooks()}} readings{{($lesson->totalQuizzes() > 0)? ',' : ''}} @endif  @if ($lesson->totalQuizzes() > 0) {{$lesson->totalQuizzes()}} quizzes @endif --}}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pt-4rem"></div>
            </div>
        </div>
    </section>
    
    <section class="review-area section-gap">
        <div class="cust-container">
            <div class="row mb-60">
                <div class="col-12">
                    <h5 class="title-review">Reviews</h5>
                </div>
                <div class="col-lg-4" style="min-width: 360px;margin-bottom:40px;">
                    <div class="w-100">
                        <h5 class="mb-2">Average user rating</h5>
                        <div class="d-flex align-items-center">
                            <div class="box-left-review">
                                <div class="w-100">
                                    <h2 class="number-text-review">{{$courseDetailRating->avg_rating}} <small>/ 5</small></h2>
                                </div>
                            </div>
                            <div>
                                <div class="w-100 text-warning star-text-review">
                                    @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $courseDetailRating->avg_rating)
                                    <span class="fas fa-star"></span>
                                    @else
                                    @if ($i == ceil($courseDetailRating->avg_rating))
                                    <span class="fas fa-star-half-alt"></span>
                                    @else
                                    <span class="far fa-star"></span>
                                    @endif
                                    @endif
                                    @endfor
                                </div>
                                <div class="w-100 star-sub-text-review">
                                    {{number_format($courseDetailRating->total, 0, ',', '.')}} review{{($courseDetailRating->total > 1)? 's' : ''}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 mt-4">
                        <div class="w-100">
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td class="text-center" style="width: 40px">
                                            <span class="text-black">5 <i class="fas fa-star checked text-warning"></i></span>
                                        </td>
                                        <td style="width: 250px">
                                            <div class="progress rounded-0">
                                                <div class="progress-bar custom-bg-orange" role="progressbar" style="width: {{$courseDetailRating->percent_5_rating}}%" aria-valuenow="{{$courseDetailRating->percent_5_rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="pl-2 text-black">{{$courseDetailRating->percent_5_rating}}%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width: 40px">
                                            <span class="text-black">4 <i class="fas fa-star checked text-warning"></i></span>
                                        </td>
                                        <td style="width: 250px">
                                            <div class="progress rounded-0">
                                                <div class="progress-bar custom-bg-orange" role="progressbar" style="width: {{$courseDetailRating->percent_4_rating}}%" aria-valuenow="{{$courseDetailRating->percent_4_rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="pl-2 text-black">{{$courseDetailRating->percent_4_rating}}%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width: 40px">
                                            <span class="text-black">3 <i class="fas fa-star checked text-warning"></i></span>
                                        </td>
                                        <td style="width: 250px">
                                            <div class="progress rounded-0">
                                                <div class="progress-bar custom-bg-orange" role="progressbar" style="width: {{$courseDetailRating->percent_3_rating}}%" aria-valuenow="{{$courseDetailRating->percent_3_rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="pl-2 text-black">{{$courseDetailRating->percent_3_rating}}%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width: 40px">
                                            <span class="text-black">2 <i class="fas fa-star checked text-warning"></i></span>
                                        </td>
                                        <td style="width: 250px">
                                            <div class="progress rounded-0">
                                                <div class="progress-bar custom-bg-orange" role="progressbar" style="width: {{$courseDetailRating->percent_2_rating}}%" aria-valuenow="{{$courseDetailRating->percent_2_rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="pl-2 text-black">{{$courseDetailRating->percent_2_rating}}%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width: 40px">
                                            <span class="text-black" style="padding-left: 3px;">1 <i class="fas fa-star checked text-warning"></i></span>
                                        </td>
                                        <td style="width: 250px">
                                            <div class="progress rounded-0">
                                                <div class="progress-bar custom-bg-orange" role="progressbar" style="width: {{$courseDetailRating->percent_1_rating}}%" aria-valuenow="{{$courseDetailRating->percent_1_rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="pl-2 text-black">{{$courseDetailRating->percent_1_rating}}%</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 content-user-review">
                    <div class="w-100">
                        <h5 class="mb-2">All Ratings and Reviews</h5>
                    </div>
                    <div class="card rounded-0 border-0">
                        @forelse ($courseReviews as $rating_item)
                        <div class="card-body border-bottom">
                            <div class="box-user-review w-100 text-black">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6>{{$rating_item->user->name}}</h6>
                                        <p>{{date('F d, Y', strtotime($rating_item->updated_at))}}</p>
                                    </div>
                                    <div class="text-warning">
                                        @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating_item->rating)
                                        <span class="fas fa-star"></span>
                                        @else
                                        <span class="far fa-star"></span>
                                        @endif
                                        @endfor
                                    </div>
                                </div>
                                <div class="w-100">
                                    <p>{{$rating_item->description}}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="card-body border-bottom text-center">
                            <h5 class="text-muted font-weight-normal">No reviews yet.</h5>
                        </div>
                        @endforelse
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::guard('web')->check() && $course_is_purchased)
            
            @if ($user_course_review && !($form_is_edit_review))
            <div class="card rounded-0 border-0 content-form-review">
                <div class="card-body">
                    <h6 class="title-form mb-4">My Review</h6>
                    <div class="w-100 border-top pt-3">
                        <div class="box-user-review w-100 text-black">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6>{{$user_course_review->user->name}}</h6>
                                    <p>{{date('F d, Y', strtotime($user_course_review->updated_at))}}</p>
                                </div>
                                <div class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $user_course_review->rating)
                                    <span class="fas fa-star"></span>
                                    @else
                                    <span class="far fa-star"></span>
                                    @endif
                                    @endfor
                                </div>
                            </div>
                            <div class="w-100">
                                <p>{{$user_course_review->description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 mt-50 text-right">
                        <button wire:click="editReview" wire:loading.remove class="genric-btn primary">Edit Review</button>
                        <button wire:loading class="genric-btn primary custom-disable" style="display: none;"> <i class="fas fa-circle-notch fa-spin"></i> Edit Review</button>
                    </div>
                </div>
            </div>
            @else
            <div class="card rounded-0 border-0 content-form-review">
                <div class="card-body">
                    <form wire:submit.prevent="submitReview">
                        <h6 class="title-form">Leave Review</h6>
                        <div class="w-100 mb-4">
                            <p class="text-black mb-1">Rate the Course<small class="text-danger">*</small></p>
                            <div class="d-flex">
                                <fieldset class="rating-fieldset rating">
                                    <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star5" name="rating" value="5" data-title="Awesome" /><label class="rating-label full" for="star5" title="Awesome - 5 Stars"></label>
                                    <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star4" name="rating" value="4" data-title="Pretty good" /><label class="rating-label full" for="star4" title="Pretty good - 4 Stars"></label>
                                    <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star3" name="rating" value="3" data-title="Good" /><label class="rating-label full" for="star3" title="Good - 3 Stars"></label>
                                    <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star2" name="rating" value="2" data-title="Kinda bad" /><label class="rating-label full" for="star2" title="Kinda bad - 2 Stars"></label>
                                    <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star1" name="rating" value="1" data-title="Bad" /><label class="rating-label full" for="star1" title="Bad - 1 Star"></label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="w-100 mb-4">
                            <p class="text-black mb-1">Your Review</p>
                            <textarea wire:model.defer="rating_desc" class="form-control" name="description" rows="4"></textarea>
                        </div>
                        <div class="w-100 text-right">
                            <button wire:loading.remove class="genric-btn primary">Submit Review</button>
                            <button wire:loading class="genric-btn primary custom-disable" style="display: none;"> <i class="fas fa-circle-notch fa-spin"></i> Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            @endif
        </div>
    </section>
    
    <!-- Start cta-one Area -->
    <section class="cta-one-area relative section-gap">
        <div class="container">
            <div class="overlay overlay-bg"></div>
            <div class="row justify-content-center">
                <div class="wrap">
                    <h1 class="text-white">Become an instructor</h1>
                    <p>
                        There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station whether that is on the deck.
                    </p>
                    <a class="primary-btn wh" href="#">Apply for the post</a>								
                </div>					
            </div>
        </div>	
    </section>
    <!-- End cta-one Area -->
    
    <!-- Start blog Area -->
    <section class="blog-area section-gap" id="blog">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Latest posts from our Blog</h1>
                        <p>In the history of modern astronomy there is.</p>
                    </div>
                </div>
            </div>					
            <div class="row">
                <div class="col-lg-3 col-md-6 single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/b1.jpg')}}" alt="">								
                    </div>
                    <p class="meta">25 April, 2018  |  By <a href="#">Mark Wiens</a></p>
                    <a href="blog-single.html">
                        <h5>Addiction When Gambling Becomes A Problem</h5>
                    </a>
                    <p>
                        Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their.
                    </p>
                    <a href="#" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>		
                </div>
                <div class="col-lg-3 col-md-6 single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/b2.jpg')}}" alt="">								
                    </div>
                    <p class="meta">25 April, 2018  |  By <a href="#">Mark Wiens</a></p>
                    <a href="blog-single.html">
                        <h5>Computer Hardware Desktops And Notebooks</h5>
                    </a>
                    <p>
                        Ah, the technical interview. Nothing like it. Not only does it cause anxiety, but it causes anxiety for several different reasons. 
                    </p>
                    <a href="#" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>						
                </div>
                <div class="col-lg-3 col-md-6 single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/b3.jpg')}}" alt="">								
                    </div>
                    <p class="meta">25 April, 2018  |  By <a href="#">Mark Wiens</a></p>
                    <a href="blog-single.html">
                        <h5>Make Myspace Your Best Designed Space</h5>
                    </a>
                    <p>
                        Plantronics with its GN Netcom wireless headset creates the next generation of wireless headset and other products such as wireless.
                    </p>
                    <a href="#" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>									
                </div>
                <div class="col-lg-3 col-md-6 single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/b4.jpg')}}" alt="">								
                    </div>
                    <p class="meta">25 April, 2018  |  By <a href="#">Mark Wiens</a></p>
                    <a href="blog-single.html">
                        <h5>Video Games Playing With Imagination</h5>
                    </a>
                    <p>
                        About 64% of all on-line teens say that do things online that they wouldn’t want their parents to know about.   11% of all adult internet 
                    </p>
                    <a href="#" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>							
                </div>							
            </div>
        </div>	
    </section>
    <!-- End blog Area -->		
</div>

@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
    document.addEventListener('notification:success', function (event) {
        var swalOptions = {
            icon: 'success',
            title: event.detail.title,
            text: event.detail.message,
        }
        Swal.fire(swalOptions);
    })
</script>
@endpush
