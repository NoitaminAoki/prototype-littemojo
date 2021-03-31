@extends('homepage.layouts.main')
@section('font-awesome', 'new')
@section('css')
<style>
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
    
    /* End Imported Admin LTE CSS */
    
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
</style>
@endsection

@section('content')
<section class="header-area banner-gradient-color">
</section>
<!-- start banner Area -->
<section class="banner-area banner-gradient-color relative about-banner" id="home">	
    <div class="px-5 pt-4">				
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
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
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
                <div class="col-lg-8">
                    <h4 class="headline-4-text font-weight-bold">About this Course</h4>
                    <div class="pr-1 my-4">
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
                                        <span class="custom-info-box-text">{{$exp_item->name}}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-100 px-3 pt-3 border mt-3">
                        <h3 class="headline-desc-course text-secondary">SKILLS YOU WILL GAIN</h3>
                        <br>
                        <div class="d-flex flex-wrap mt-3">
                            @foreach ($course->skills as $skill_item)
                            <div class="skill-content py-1 px-3 my-1 mx-2">{{$skill_item->skill->name}}</div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-4 pl-4">
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
                            <span class="info-box-text"><h5 class="mb-0">flexible schedules</h5></span>
                            <span class="info-box-text"> free to choose a start date </span>
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
                            <span class="info-box-text">IDR {{number_format($course->price, 0)}} </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
<!-- End events-list Area -->

<!-- Start review Area -->
<section class="review-area section-gap relative">
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
@endsection