@section('title', 'Course')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
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
    .banner-title {
        font-family: OpenSansBoldOptional,Arial,sans-serif;
        font-size: 34px;
        line-height: 46px;
    }
    .banner-gradient-color-blue {
        color: white;
        background-image: linear-gradient(90deg, rgb(66, 133, 244), rgb(64, 52, 168));
    }
    .banner-gradient-color-blue-purple {
        color: white;
        background-image: linear-gradient(90deg, rgb(43, 85, 165), rgb(78, 34, 113));
    }
    .text-font-family {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    a.custom-text-white:hover {
        text-decoration: underline !important;
    }
    .text-enrolled {
        font-size: 16px;
        font-weight: 400;
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
    .lesson-title {
        font-family: OpenSansBoldOptional,Arial,sans-serif;
        font-size: 24px;
    }
    
    .custom-btn-capsule {
        width: 70px;
        border-radius: 500px !important;
        text-align: end;
    }
    
    .mt-4rem {
        margin-top: 4rem;
    }
    
    .card-start {
        height: 182.4px;
    }
    /* Progress Steps 2 */
    
    .progressbar-container {
        width: 100%;
        position: relative;
        z-index: 1;
    }
    
    .progress-step li{
        position: relative;
        text-align: center;
        min-width: 100px;
    }
    
    .progress-step{
        counter-reset: step;
    }
    
    .progress-step li:before{
        content:counter(step);
        counter-increment: step;
        width: 30px;
        height: 30px;
        border: 2px solid #bebebe;
        display: block;
        margin: 0 auto 10px auto;
        border-radius: 50%;
        line-height: 27px;
        background: white;
        color: #bebebe;
        text-align: center;
        font-weight: bold;
    }
    
    .progress-step li:after{
        content: '';
        position: absolute;
        width:100%;
        height: 3px;
        background: #979797;
        top: 15px;
        left: -50%;
        z-index: -1;
    }
    
    .progress-step li:first-child:after{
        content: none;
    }
    
    .progress-step li.active:after{
        background: #3aac5d;
    }
    
    .progress-step li.active:before{
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f00c";
        border-color: #3aac5d;
        background: #3aac5d;
        color: white;
    }
    
    .progress-step li.ongoing:after{
        background: #3a6fac;
    }
    
    .progress-step li.ongoing:before{
        font-family: "Font Awesome 5 Free";
        font-weight: 400;
        content: "\f254";
        border-color: #3a6fac;
        background: #3a6fac;
        color: white;
    }
    
    .title-progress {
        margin-bottom: 4rem;
    }
    
    .title-progress > .title-header {
        /* color: #673AB7; */
        color: #3a66b7;
        font-weight: normal;
    }
    
    .small-title {
        font-weight: 600;
    }
    
    /* End Progress Steps */
    
    /* Vertical Progress Steps */
    
    .progress-vertical li { 
        display: flex; 
        color: #999;
    }
    
    .progress-vertical time { 
        position: relative;
        padding: 0 1em;
        line-height: 1rem;
        width: 0;
    }
    
    .progress-vertical time::after { 
        content: "";
        position: absolute;
        z-index: 2;
        right: 0;
        top: 0;
        transform: translateX(50%);
        border-radius: 50%;
        background: #fff;
        border: 1px #ccc solid;
        width: .8em;
        height: .8em;
    }
    
    
    .progress-vertical span {
        padding: 0 1.5em 1.5em 1.5em;
        position: relative;
    }
    
    .progress-vertical span::before {
        content: "";
        position: absolute;
        z-index: 1;
        left: 0;
        height: 100%;
        border-left: 1px #ccc solid;
    }
    
    .progress-vertical li:last-child span::before {
        border: none;
    }
    
    .progress-vertical li:last-child time:after {
        border-color: #3a6fac;
        background-color: #3a6fac;
    }
    
    .progress-vertical li.active > time::after {
        border-color: #3aac5d;
        background-color: #3aac5d;
    }
    
    .progress-vertical li.active > span::before {
        border-color: #3aac5d;
    }
    
    .progress-vertical strong {
        display: block;
        font-weight: bolder;
        line-height: 1rem;
    }
    
    .progress-vertical { margin: 1em; width: 50%; }
    .progress-vertical, 
    .progress-vertical *::before, 
    .progress-vertical *::after { box-sizing: border-box; font-family: arial; }
    
    /* End Vertical Progress Steps */
    
    
    /* Custom media query for Vertical Progress */
    @media (max-width: 576px) {
        .progress-parent {
            margin-top: 3rem;
        }
        .progress-vertical {
            margin-left: 0;
        }
        .progress-vertical time {
            padding-right: 0;
        }
    }
    /* End Custom media query for Vertical Progress */
    
    /* Countdown Timer */
    .countdown li {
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
        list-style: none;
        display: inline-block;
        margin: 0 20px;
    }
    .countdown span {
        font-size: 25px;
    }
    .countdown h3 {
        font-size: 14px;
        text-transform: uppercase;
        margin: 10px 0;
    }
    /* EndCountdown Timer */
    
    .bg-image {
        background-position: center center;
        background-size: cover;
    }
    
    .bg-image .bg-overlay {
        background: linear-gradient(to top right, #d2b48c, #000000);
        opacity: 0.9;
    }
    .bg-image-countdown-1 {
        color: #ffffff;
        background-image: url(http://localhost:8000/page_dist/img/countdown-timer-bg-1.jpg);
    }
    .bg-image-countdown-2 {
        color: #ffffff;
        background-image: url(http://localhost:8000/page_dist/img/countdown-timer-bg-2.png);
    }
    .bg-image-countdown-3 {
        color: #ffffff;
        background-image: url(http://localhost:8000/page_dist/img/countdown-timer-bg-3.jpg);
    }
    
</style>
@endsection
@php
$date_transaction = $course->getDateTransaction(Auth::guard('web')->user()->id);
$date_countdown = ($course->isAccessible(Auth::guard('web')->user()->id))? $date_transaction->end_date : $date_transaction->start_date;
@endphp
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="col-12 banner-gradient-color-blue">
                    <div class="px-4 py-3">
                        <div class="row">
                            <div class="col-md-6">
                                <ol class="breadcrumb pl-0" style="background-color: transparent">
                                    <li class=""><a href="#" class="text-white custom-text-white text-decoration-none font-weight-bold">Browse</a></li>
                                    <li class="">
                                        <span class="d-flex align-items-center h-100">
                                            <svg class="chevron-right-avg" aria-hidden="true" focusable="false" viewBox="0 0 48 48" role="img" aria-labelledby="ChevronRightfea0a322-8175-469f-d034-c9feaa91d4e4 ChevronRightfea0a322-8175-469f-d034-c9feaa91d4e4Desc" xmlns="http://www.w3.org/2000/svg"><polygon transform="translate(23.999500, 24.000000) scale(-1, 1) translate(-23.999500, -24.000000)" points="16 24 30.585 40 31.999 38.586 18.828 24 31.999 9.415 30.585 8" role="presentation"></polygon></svg>
                                        </span>
                                    </li>
                                    <li class=""><a href="#" class="text-white custom-text-white text-decoration-none font-weight-bold">{{$course->catalog_title}}</a></li>
                                    <li class="">
                                        <span class="d-flex align-items-center h-100">
                                            <svg class="chevron-right-avg" aria-hidden="true" focusable="false" viewBox="0 0 48 48" role="img" aria-labelledby="ChevronRightfea0a322-8175-469f-d034-c9feaa91d4e4 ChevronRightfea0a322-8175-469f-d034-c9feaa91d4e4Desc" xmlns="http://www.w3.org/2000/svg"><polygon transform="translate(23.999500, 24.000000) scale(-1, 1) translate(-23.999500, -24.000000)" points="16 24 30.585 40 31.999 38.586 18.828 24 31.999 9.415 30.585 8" role="presentation"></polygon></svg>
                                        </span>
                                    </li>
                                    <li class=""><a href="#" class="text-white custom-text-white text-decoration-none font-weight-bold">{{$course->catalog_topic_title}}</a></li>
                                </ol>
                                <h2 class="font-weight-bold text-light banner-title"> {{$course->title}} </h2>
                                <div class="text-warning mt-2">
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star-half-alt checked"></span>
                                    <span class="far fa-star"></span>
                                    <span class="ml-1 text-rating">4.6</span>
                                    <span class="ml-1 text-white text-rating">86,528 ratings</span>
                                </div>
                                <div class="mt-5 text-enrolled">
                                    <span><strong class="font-weight-bold">500,231</strong> Already enrolled</span>
                                </div>
                                
                                <br>
                            </div>
                            <div class="col-md-6 offer-area">
                                <p class="text-light text-offer-by mb-0">Offered By</p>
                                <img class="image-offer-by" src="{{asset($course->corporation->path_logo)}}" alt="{{$course->corporation->name}}" title="{{$course->corporation->name}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if ($course->isAccessible(Auth::guard('web')->user()->id))
    <div class="col-md-4">
        <div class="card rounded-0 card-outline card-danger card-start">
            <div class="card-body">
                <h4 class="text-sm text-muted">EXPIRATION DATE</h4>
                <h3 class="text-font-family text-right">{{date("d F Y", strtotime($date_transaction->end_date))}}</h3>
                <h5 class="text-sm text-right">{{date("H:i:s A", strtotime($date_transaction->end_date))}}</h5>
                <hr class="mb-0">
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card rounded-0 bg-image bg-image-countdown-3">
            <div class="card-body bg-overlay">
                <h5 class="text-center text-font-family mb-1 text-lg text-uppercase">Countdown</h5>
                <h6 class="text-center text-font-family mb-4 text-sm">Your course will end in:</h6>
                <ul class="countdown list-unstyled text-center mb-0">
                    <li>
                        <span class="days">00</span>
                        <h3>Days</h3>
                    </li>
                    <li>
                        <span class="hours">00</span>
                        <h3>hours</h3>
                    </li>
                    <li>
                        <span class="minutes">00</span>
                        <h3>minutes</h3>
                    </li>
                    <li>
                        <span class="seconds">00</span>
                        <h3>seconds</h3>
                    </li>     
                </ul>
            </div>
        </div>
    </div>      
    @else
    <div class="col-md-4">
        <div class="card rounded-0 card-outline card-purple card-start">
            <div class="card-body">
                <h4 class="text-sm text-muted">START DATE</h4>
                <h3 class="text-font-family text-right">{{date("d F Y", strtotime($date_transaction->start_date))}}</h3>
                <h5 class="text-sm text-right">{{date("H:i:s A", strtotime($date_transaction->start_date))}}</h5>
                <hr class="mb-0">
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card rounded-0 bg-image bg-image-countdown-1">
            <div class="card-body">
                <h5 class="text-center text-font-family mb-1 text-lg text-uppercase">Countdown</h5>
                <h6 class="text-center text-font-family mb-4 text-sm">Get ready, your course can be accessed in:</h6>
                <ul class="countdown list-unstyled text-center mb-0">
                    <li>
                        <span class="days">00</span>
                        <h3>Days</h3>
                    </li>
                    <li>
                        <span class="hours">00</span>
                        <h3>hours</h3>
                    </li>
                    <li>
                        <span class="minutes">00</span>
                        <h3>minutes</h3>
                    </li>
                    <li>
                        <span class="seconds">00</span>
                        <h3>seconds</h3>
                    </li>     
                </ul>
            </div>
        </div>
    </div>
    @endif
    
    
    <div class="col-12">
        <div class="card rounded">
            <div class="card-body">
                <div class="title-progress text-center">
                    <h2 class="title-header text-uppercase">Course Progress</h2>
                    <p class="text-muted">Complete the lesson to go to the next lesson</p>
                </div>
                <div class="progressbar-container table-responsive">
                    <ul class="progress-step list-unstyled d-flex text-font-family">
                        @php
                        $first_ongoing = true;
                        $ordering = 0;
                        @endphp
                        @foreach ($course->lessons as $lesson)
                        @if ($lesson->isFinished(Auth::guard('web')->user()->id))
                        <li class="flex-fill active">Lesson {{$loop->iteration}}</li>
                        @php
                        $ordering += 1;
                        @endphp
                        @else
                        @if ($first_ongoing)
                        <li class="flex-fill ongoing">Lesson {{$loop->iteration}}</li>
                        @php
                        $first_ongoing = false;
                        $ordering += 1;
                        @endphp
                        @else
                        <li class="flex-fill">Lesson {{$loop->iteration}}</li>
                        @endif
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-12" style="margin-top: 60px; margin-bottom: 60px;">
                    <hr>
                </div>
                <div class="row">
                    @php
                    $user_id = Auth::guard('web')->user()->id;
                    $lesson_progress = $selected_lesson->getTotalProgress($user_id);
                    @endphp
                    <div class="col-md-7 pr-4">
                        <div class="d-flex">
                            <div class="border-right pr-2">
                                <h3 class="text-font-family font-weight-bold mb-0" style="font-size: 3.5rem;">{{$ordering}}</h3>
                            </div>
                            <div class="d-flex align-items-center ml-2">
                                <div>
                                    <span class="text-sm small-title text-font-family">Lesson</span>
                                    <h4 class="font-weight-bold lesson-title mb-0"> {{$selected_lesson->title}} </h4>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 mt-4">
                            <div class="d-flex justify-content-between align-items-end mb-1">
                                <small class="text-secondary"><b>PROGRESS</b> {{$lesson_progress->percentage}}% complete</small>
                                <h4 class="text-font-family text-lg mb-0 text-secondary">{{$lesson_progress->inprogress}}/{{$lesson_progress->total}}</h4>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="{{$lesson_progress->percentage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$lesson_progress->percentage}}%">
                                    <span class="sr-only">{{$lesson_progress->percentage}}% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 mt-4rem text-right">
                            @if ($course->isAccessible(Auth::guard('web')->user()->id))
                            <a href="{{ route('home.dashboard.course.lesson', ['title'=>$slug_course_name, 'lesson_id' => $selected_lesson->id]) }}" class="custom-btn-capsule btn btn-primary"><i class="fas fa-arrow-right"></i></a>
                            @else
                            <button id="btn_disable_access" class="btn btn-primary custom-btn-capsule disabled text-center"><i class="far fa-hourglass fa-pulse"></i></button>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5 progress-parent border-left">
                        <ul class="progress-vertical w-100 list-unstyled">
                            @foreach ($selected_lesson->videos as $video)
                            <li class="{{($video->isFinished($user_id))? 'active' : ''}}">
                                <time datetime=""></time> 
                                <span><strong>Video</strong> {{$video->title}} </span>
                            </li>
                            @endforeach
                            @foreach ($selected_lesson->books as $book)
                            <li class="{{($book->isFinished($user_id))? 'active' : ''}}">
                                <time datetime=""></time> 
                                <span><strong>Reading</strong> {{$book->title}} </span>
                            </li>
                            @endforeach
                            @foreach ($selected_lesson->quizzes as $quiz)
                            <li class="{{($quiz->isFinished($user_id))? 'active' : ''}}">
                                <time datetime=""></time> 
                                <span><strong>Quiz</strong> {{$quiz->title}} </span>
                            </li>
                            @endforeach
                            <li class="">
                                <time datetime=""></time> 
                                <span><strong>END</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    
</div>


@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{date('F, d Y H:i:s A', strtotime($date_countdown))}}").getTime();
    var now = new Date().getTime();
    var x_interval;
    
    $(document).ready(function() {
        
        if(countDownDate >= now) {
            x_interval = setInterval(startCountDown, 1000);
        }
    });

    $("#btn_disable_access").on('click', function() {
        Swal.fire( {
            icon: 'warning',
            title: 'Oops...',
            html: 'You can access the course when the time has comes.',
        });
    });
    // Update the count down every 1 second
    function startCountDown() {
        function leadingZero(number) {
            return ("00" + number).slice (-2);
        }
        // Get today's date and time
        let now = new Date().getTime();
        
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Output the result in an element with id="demo"
        $('.countdown span.days').text(leadingZero(days));
        $('.countdown span.hours').text(leadingZero(hours));
        $('.countdown span.minutes').text(leadingZero(minutes));
        $('.countdown span.seconds').text(leadingZero(seconds));
        
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x_interval);
            $('.countdown span.days').text("00");
            $('.countdown span.hours').text("00");
            $('.countdown span.minutes').text("00");
            $('.countdown span.seconds').text("00");
            Swal.fire( {
                icon: 'success',
                title: "Horay!",
                text: "Now you can access the course by refreshing page browser.",
            });
        }
    }
</script>
@endpush