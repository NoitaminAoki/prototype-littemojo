@extends('homepage.layouts.main')

@section('css')
<style>
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
        padding: .75rem 1rem;
    }
</style>
@endsection

@section('content')
<section class="header-area banner-gradient-color">
</section>
<!-- start banner Area -->
<section class="banner-area banner-gradient-color relative about-banner" id="home">	
    <div class="px-5">				
        <div class="row">
            <div class="col-md-7">
                <ol class="breadcrumb pl-0" style="background-color: transparent">
                    <li class="mx-1"><a href="{{ route('partner.manage.course.index') }}" class="text-white custom-text-white text-decoration-none">Course</a></li>
                    <li class="mx-1"><i class="fa fa-chevron-right text-sm "></i></li>
                    <li class="mx-1"><a href="{{ route('partner.manage.course.index') }}" class="text-white custom-text-white text-decoration-none">[Catalog]</a></li>
                    <li class="mx-1"><i class="fa fa-chevron-right text-sm"></i></li>
                    <li class="mx-1"><a href="{{ route('partner.manage.course.index') }}" class="text-white custom-text-white text-decoration-none">[Catalog Topic]</a></li>
                </ol>
                <h2 class="font-weight-bold text-light"> [Course Title] </h2>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <div class="col-md-5">
                <h5 class="text-light text-offer-by">Offered By</h5>
                <img src="" alt="">
            </div>
        </div>
    </div>
    {{-- <div class="overlay overlay-bg"></div> --}}
    {{-- <div class="container">				
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Events				
                </h1>	
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="events.html"> Events</a></p>
            </div>	
        </div>
    </div> --}}
</section>
<!-- End banner Area -->	
<!-- Start events-list Area -->
<section class="events-list-area section-gap event-page-lists">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 pb-30">
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="img/e1.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="event-details.html"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pb-30">
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="img/e2.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="event-details.html"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pb-30">
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="img/e1.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="event-details.html"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pb-30">
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="img/e2.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="event-details.html"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pb-30">
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="img/e1.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="event-details.html"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" pb-30>
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="img/e2.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="event-details.html"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pb-30">
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="img/e1.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="event-details.html"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="img/e2.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
            </div>																		
            <a href="#" class="text-uppercase primary-btn mx-auto mt-40">Load more courses</a>		
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