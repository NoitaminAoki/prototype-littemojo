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
</section>
<!-- End banner Area -->	

<!-- Start course-details Area -->
<section class="course-details-area pt-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 left-contents">
                <div class="main-image">
                    <img class="img-fluid" src="img/m-img.jpg" alt="">
                </div>
                <div class="jq-tab-wrapper" id="horizontalTab">
                    <div class="jq-tab-menu">
                        <div class="jq-tab-title active" data-tab="1">Objectives</div>
                        <div class="jq-tab-title" data-tab="2">Eligibility</div>
                        <div class="jq-tab-title" data-tab="3">Course Outline</div>
                        <div class="jq-tab-title" data-tab="4">Comments</div>
                        <div class="jq-tab-title" data-tab="5">Reviews</div>
                    </div>
                    <div class="jq-tab-content-wrapper">
                        <div class="jq-tab-content active" data-tab="1">
                            When you enter into any new area of science, you almost always find yourself with a baffling new language of technical terms to learn before you can converse with the experts. This is certainly true in astronomy both in terms of terms that refer to the cosmos and terms that describe the tools of the trade, the most prevalent being the telescope.
                            <br>
                            <br>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                        </div>
                        <div class="jq-tab-content" data-tab="2">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                            <br>
                            <br>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                        </div>
                        <div class="jq-tab-content" data-tab="3">
                            <ul class="course-list">
                                <li class="justify-content-between d-flex">
                                    <p>Introduction Lesson</p>
                                    <a class="primary-btn text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <p>Basics of HTML</p>
                                    <a class="primary-btn text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <p>Getting Know about HTML</p>
                                    <a class="primary-btn text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <p>Tags and Attributes</p>
                                    <a class="primary-btn text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <p>Basics of CSS</p>
                                    <a class="primary-btn text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <p>Getting Familiar with CSS</p>
                                    <a class="primary-btn text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <p>Introduction to Bootstrap</p>
                                    <a class="primary-btn text-uppercase" href="#">View Details</a>
                                </li>																		
                                <li class="justify-content-between d-flex">
                                    <p>Responsive Design</p>
                                    <a class="primary-btn text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <p>Canvas in HTML 5</p>
                                    <a class="primary-btn text-uppercase" href="#">View Details</a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="jq-tab-content comment-wrap" data-tab="4">
                            <div class="comments-area">
                                <h4>05 Comments</h4>
                                <div class="comment-list">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="img/blog/c1.jpg" alt="">
                                            </div>
                                            <div class="desc">
                                                <h5><a href="#">Emilly Blunt</a></h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                                <p class="comment">
                                                    Never say goodbye till the end comes!
                                                </p>
                                            </div>
                                        </div>
                                        <div class="reply-btn">
                                            <a href="" class="btn-reply text-uppercase">reply</a> 
                                        </div>
                                    </div>
                                </div>  
                                <div class="comment-list left-padding">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="img/blog/c2.jpg" alt="">
                                            </div>
                                            <div class="desc">
                                                <h5><a href="#">Elsie Cunningham</a></h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                                <p class="comment">
                                                    Never say goodbye till the end comes!
                                                </p>
                                            </div>
                                        </div>
                                        <div class="reply-btn">
                                            <a href="" class="btn-reply text-uppercase">reply</a> 
                                        </div>
                                    </div>
                                </div>   
                                <div class="comment-list">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="img/blog/c4.jpg" alt="">
                                            </div>
                                            <div class="desc">
                                                <h5><a href="#">Maria Luna</a></h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                                <p class="comment">
                                                    Never say goodbye till the end comes!
                                                </p>
                                            </div>
                                        </div>
                                        <div class="reply-btn">
                                            <a href="" class="btn-reply text-uppercase">reply</a> 
                                        </div>
                                    </div>
                                </div>                                                    
                            </div>
                            <div class="comment-form">
                                <h4>Leave a Comment</h4>
                                <form>
                                    <div class="form-group form-inline">
                                        <div class="form-group col-lg-6 col-md-12 name">
                                            <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 email">
                                            <input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                                        </div>                                        
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                                    </div>
                                    <a href="#" class="mt-40 text-uppercase genric-btn primary text-center">Post Comment</a> 
                                </form>
                            </div>     						                
                        </div>
                        <div class="jq-tab-content" data-tab="5">	
                            <div class="review-top row pt-40">
                                <div class="col-lg-3">
                                    <div class="avg-review">
                                        Average <br>
                                        <span>5.0</span> <br>
                                        (3 Ratings)
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <h4 class="mb-20">Provide Your Rating</h4>
                                    <div class="d-flex flex-row reviews">
                                        <span>Quality</span>
                                        <div class="star">
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <span>Outstanding</span>
                                    </div>
                                    <div class="d-flex flex-row reviews">
                                        <span>Puncuality</span>
                                        <div class="star">
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <span>Outstanding</span>
                                    </div>
                                    <div class="d-flex flex-row reviews">
                                        <span>Quality</span>
                                        <div class="star">
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <span>Outstanding</span>
                                    </div>
                                </div>
                            </div>
                            <div class="feedeback">
                                <h4 class="pb-20">Your Feedback</h4>
                                <textarea name="feedback" class="form-control" cols="10" rows="10"></textarea>
                                <a href="#" class="mt-20 primary-btn text-right text-uppercase">Submit</a>
                            </div>
                            <div class="comments-area mb-30">
                                <div class="comment-list">
                                    <div class="single-comment single-reviews justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="img/blog/c1.jpg" alt="">
                                            </div>
                                            <div class="desc">
                                                <h5><a href="#">Emilly Blunt</a>
                                                    <div class="star">
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                </h5>
                                                <p class="comment">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ut sed, dolorum asperiores perspiciatis provident, odit maxime doloremque aliquam.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="comment-list">
                                    <div class="single-comment single-reviews justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="img/blog/c2.jpg" alt="">
                                            </div>
                                            <div class="desc">
                                                <h5><a href="#">Elsie Cunningham</a>
                                                    <div class="star">
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                </h5>
                                                <p class="comment">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ut sed, dolorum asperiores perspiciatis provident, odit maxime doloremque aliquam.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                                <div class="comment-list">
                                    <div class="single-comment single-reviews justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="img/blog/c3.jpg" alt="">
                                            </div>
                                            <div class="desc">
                                                <h5><a href="#">Maria Luna</a>
                                                    <div class="star">
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                </h5>
                                                <p class="comment">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ut sed, dolorum asperiores perspiciatis provident, odit maxime doloremque aliquam.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="comment-list">
                                    <div class="single-comment single-reviews justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="img/blog/c4.jpg" alt="">
                                            </div>
                                            <div class="desc">
                                                <h5><a href="#">Maria Luna</a>
                                                    <div class="star">
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                </h5>
                                                <p class="comment">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ut sed, dolorum asperiores perspiciatis provident, odit maxime doloremque aliquam.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>  						                                                                      
                            </div>	                                	
                        </div>                                
                    </div>
                </div>
            </div>
            <div class="col-lg-4 right-contents">
                <ul>
                    <li>
                        <a class="justify-content-between d-flex" style="cursor: default;" href="javascript:void(0);">
                            <p>Offered By</p> 
                            <span class="or">{{$course->corporation->name}}</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" style="cursor: default;" href="javascript:void(0);">
                            <p>Course Price </p>
                            <span>{{number_format($course->price, 0, ',', '.')}} IDR</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" style="cursor: default;" href="javascript:void(0);">
                            <p>Schedule </p>
                            <span>2.00 pm to 4.00 pm</span>
                        </a>
                    </li>
                </ul>
                <a href="#" class="primary-btn text-uppercase">Enroll the course</a>
            </div>
        </div>
    </div>	
</section>
<!-- End course-details Area -->


<!-- Start popular-courses Area --> 
<section class="popular-courses-area section-gap courses-page">
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
            <div class="single-popular-carusel col-lg-3 col-md-6">
                <div class="thumb-wrap relative">
                    <div class="thumb relative">
                        <div class="overlay overlay-bg"></div>	
                        <img class="img-fluid" src="img/p1.jpg" alt="">
                    </div>
                    <div class="meta d-flex justify-content-between">
                        <p><span class="lnr lnr-users"></span> 355 <span class="lnr lnr-bubble"></span>35</p>
                        <h4>$150</h4>
                    </div>									
                </div>
                <div class="details">
                    <a href="#">
                        <h4>
                            Learn Designing
                        </h4>
                    </a>
                    <p>
                        When television was young, there was a hugely popular show based on the still popular fictional characte										
                    </p>
                </div>
            </div>	
            <div class="single-popular-carusel col-lg-3 col-md-6">
                <div class="thumb-wrap relative">
                    <div class="thumb relative">
                        <div class="overlay overlay-bg"></div>	
                        <img class="img-fluid" src="img/p2.jpg" alt="">
                    </div>
                    <div class="meta d-flex justify-content-between">
                        <p><span class="lnr lnr-users"></span> 355 <span class="lnr lnr-bubble"></span>35</p>
                        <h4>$150</h4>
                    </div>									
                </div>
                <div class="details">
                    <a href="#">
                        <h4>
                            Learn React js beginners
                        </h4>
                    </a>
                    <p>
                        When television was young, there was a hugely popular show based on the still popular fictional characte										
                    </p>
                </div>
            </div>	
            <div class="single-popular-carusel col-lg-3 col-md-6">
                <div class="thumb-wrap relative">
                    <div class="thumb relative">
                        <div class="overlay overlay-bg"></div>	
                        <img class="img-fluid" src="img/p3.jpg" alt="">
                    </div>
                    <div class="meta d-flex justify-content-between">
                        <p><span class="lnr lnr-users"></span> 355 <span class="lnr lnr-bubble"></span>35</p>
                        <h4>$150</h4>
                    </div>									
                </div>
                <div class="details">
                    <a href="#">
                        <h4>
                            Learn Photography
                        </h4>
                    </a>
                    <p>
                        When television was young, there was a hugely popular show based on the still popular fictional characte										
                    </p>
                </div>
            </div>	
            <div class="single-popular-carusel col-lg-3 col-md-6">
                <div class="thumb-wrap relative">
                    <div class="thumb relative">
                        <div class="overlay overlay-bg"></div>	
                        <img class="img-fluid" src="img/p4.jpg" alt="">
                    </div>
                    <div class="meta d-flex justify-content-between">
                        <p><span class="lnr lnr-users"></span> 355 <span class="lnr lnr-bubble"></span>35</p>
                        <h4>$150</h4>
                    </div>									
                </div>
                <div class="details">
                    <a href="#">
                        <h4>
                            Learn Surveying
                        </h4>
                    </a>
                    <p>
                        When television was young, there was a hugely popular show based on the still popular fictional characte										
                    </p>
                </div>
            </div>							
            <a href="#" class="primary-btn text-uppercase mx-auto">Load More Courses</a>													
        </div>
    </div>	
</section>
<!-- End popular-courses Area -->					
@endsection