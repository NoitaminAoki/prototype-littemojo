@extends('homepage.layouts.main')

@section('top-css')
@endsection
@section('css')
<style>
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
</style>
@endsection

@section('content')
<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>	
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-between">
            <div class="banner-content col-lg-9 col-md-12">
                <h1 class="text-uppercase">
                    We Ensure better education
                    for a better world			
                </h1>
                <p class="pt-10 pb-10">
                    In the history of modern astronomy, there is probably no one greater leap forward than the building and launch of the space telescope known as the Hubble.
                </p>
                {{-- <a href="#" class="primary-btn text-uppercase">Get Started</a> --}}
            </div>										
        </div>
    </div>					
</section>
<!-- End banner Area -->

<!-- Start feature Area -->
<section class="feature-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4>Learn Online Courses</h4>
                    </div>
                    <div class="desc-wrap">
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement
                            of technology.
                        </p>
                        <a href="#">Join Now</a>									
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4>No.1 of universities</h4>
                    </div>
                    <div class="desc-wrap">
                        <p>
                            For many of us, our very first experience of learning about the celestial bodies begins when we saw our first.
                        </p>
                        <a href="#">Join Now</a>									
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4>Huge Library</h4>
                    </div>
                    <div class="desc-wrap">
                        <p>
                            If you are a serious astronomy fanatic like a lot of us are, you can probably remember that one event.
                        </p>
                        <a href="#">Join Now</a>									
                    </div>
                </div>
            </div>												
        </div>
    </div>	
</section>
<!-- End feature Area -->

<!-- Start popular-course Area -->
<section class="popular-course-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Popular Courses we offer</h1>
                    <p>There is a moment in the life of any aspiring.</p>
                </div>
            </div>
        </div>						
        <div class="row">
            <div class="active-popular-carusel">
                @foreach ($courses->popular_courses as $popular_course)
                <div class="single-popular-carusel">
                    <a href="{{ route('home.detail.course', ['title'=>$popular_course->slug_title]) }}">
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


<!-- Start search-course Area -->
<section class="search-course-area relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-6 search-course-left">
                <h1 class="text-white">
                    Get reduced fee <br>
                    during this Summer!
                </h1>
                <p>
                    inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach.
                </p>
                <div class="row details-content">
                    <div class="col single-detials">
                        <span class="lnr lnr-graduation-hat"></span>
                        <a href="#"><h4>Expert Instructors</h4></a>		
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>						
                    </div>
                    <div class="col single-detials">
                        <span class="lnr lnr-license"></span>
                        <a href="#"><h4>Certification</h4></a>		
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>						
                    </div>								
                </div>
            </div>
            <div class="col-lg-4 col-md-6 search-course-right section-gap">
                <form class="form-wrap" action="#">
                    <h4 class="text-white pb-20 text-center mb-30">Search for Available Course</h4>		
                    <input type="text" class="form-control" name="name" placeholder="Your Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Name'" >
                    <input type="phone" class="form-control" name="phone" placeholder="Your Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Phone Number'" >
                    <input type="email" class="form-control" name="email" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address'" >
                    <div class="form-select" id="service-select">
                        <select>
                            <option datd-display="">Choose Course</option>
                            <option value="1">Course One</option>
                            <option value="2">Course Two</option>
                            <option value="3">Course Three</option>
                            <option value="4">Course Four</option>
                        </select>
                    </div>									
                    <button class="primary-btn text-uppercase">Submit</button>
                </form>
            </div>
        </div>
    </div>	
</section>
<!-- End search-course Area -->


<!-- Start upcoming-event Area -->
<section class="upcoming-event-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Upcoming Events of our Institute</h1>
                    <p>If you are a serious astronomy fanatic like a lot of us</p>
                </div>
            </div>
        </div>								
        <div class="row">
            <div class="active-upcoming-event-carusel">
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/e1.jpg')}}" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/e2.jpg')}}" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>	
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/e1.jpg')}}" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>	
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/e1.jpg')}}" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/e2.jpg')}}" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>	
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{ asset('page_dist/img/e1.jpg')}}" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>																						
            </div>
        </div>
    </div>	
</section>
<!-- End upcoming-event Area -->

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
                    <h1 class="mb-10">Here's some popular tricks</h1>
                    <p>In the history of modern astronomy there is.</p>
                </div>
            </div>
        </div>					
        <div class="row">
            @foreach ($popularBlog as $blog)
            <div class="col-lg-3 col-md-6 single-blog">
                <div class="thumb">
                    <img class="img-fluid" src="{{ Storage::url($blog->img) }}"
                    alt="{{ $blog->title }}">
                </div>
                <p class="meta">
                    {{ $blog->created_at->format('d M, Y') }}  | 
                    By <a href="#">{{ $blog->user->name }}</a>
                </p>
                <a href="blog-single.html">
                    <h5>{{ Str::limit($blog->title, 25) }}</h5>
                </a>
                <a href="{{ route('blog.show', $blog->id) }}" 
                class="btn btn-primary text-white d-inline-flex align-items-center">
                    <span class="details mr-2">Details</span>
                    <span class="lnr lnr-arrow-right"></span>
                </a>
            </div>
            @endforeach						
        </div>
    </div>	
</section>
<!-- End blog Area -->		
@endsection