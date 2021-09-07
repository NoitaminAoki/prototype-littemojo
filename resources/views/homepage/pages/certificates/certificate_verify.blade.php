@section('title',"- Certificate")

@section('top-css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Gelasio:wght@700&display=swap" rel="stylesheet">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
    .font-main {
        font-family: 'Montserrat';
    }
    
    .font-number {
        font-family: 'Gelasio';
    }
    
    .text-font-family {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
    .certificate-banner {
        background: url('{{asset("page_dist/img/certificate-banner.jpg")}}') center no-repeat;
        background-size: cover;
    }
    .about-content {
        text-align: unset;
    }
    
    .nav-link.active {
        border-bottom: 1px solid #1c89d2;
    }
    .nav-link {
        padding-left: 0;
        padding-right: 0;
        text-align: center;
        width: 10rem;
        margin: 10px 1rem;
    }
    .about-content {
        padding: 90px 15px 150px;
    }
    
    .mt-4rem {
        margin-top: 4rem;
    }
    
    .partner-name {
        text-transform: uppercase;
        font-weight: 800;
        font-size: 12px;
        min-height: 1em;
    }
    .course-title {
        font-size: 20px;
        font-weight: 900;
        margin-top: 8px;
        margin-bottom: 8px;
        line-height: 1.5em !important;
    }
    .course-catalog {
        background-image: -webkit-linear-gradient(90deg, #F0F0F0, #F0F0F0);
        background-image: -moz-linear-gradient(90deg, #F0F0F0, #F0F0F0);
        background-image: linear-gradient(90deg, rgb(240, 240, 240), rgb(240, 240, 240));
        font-size: 0.75rem;
        width: fit-content;
        text-decoration: none;
        color: black;
        padding: 0.1875rem 1.125rem;
        font-weight: normal;
    }
    .course-img-right {
        object-fit: cover;
        height: 100%;
        /* object-position: top; */
    }
    
    .min-w-25 {
        min-width: 25%;
    }
    .mx-min-1 {
        margin-right: -.25rem;
        margin-left: -.25rem;
    }
    .bg-light-gray {
        background-color: #e9ecef;
    }
    
    .custom-btn-capsule {
        width: 70px;
        border-radius: 500px !important;
        text-align: end;
    }
    .custom-border-left-2 {
        border-left: 2px solid #dee2e6!important;
    }
    
    @media (max-width: 510px) {
        .custom-nav .nav-item, .custom-nav .nav-link {
            width: 100%;
        }
    }
    @media (max-width: 768px) {
        .custom-nav {
            -ms-flex-pack: justify!important;
            justify-content: space-between!important;
        }
        .custom-nav .nav-link {
            margin-left: 0;
            margin-right: 0;
        }
    }
    .single-feature:hover {
        cursor: auto;
    }
    .single-feature:hover .title {
        background: rgba(255,255,255,0.15);
    }
    
    .text-name {
        font-size: 1.2rem;
    }
    
    .image_inner_container {
        border-radius: 50%;
        padding: 4px;
        background: #dedede;
    }
    .image_inner_container img {
        height: 100px;
        width: 100px;
        border-radius: 50%;
        border: 2px solid white;
    }
    
    .headline-4-text {
        font-size: 24px;
        line-height: 30px;
        font-family: OpenSans,Arial,sans-serif !important;
    }
    .content-offer-by {
        font-size: 14px;
        line-height: 21px;
        font-family: OpenSans,Arial,sans-serif;
        color: #373a3c;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>
@endsection

<div>
    <!-- start banner Area -->
    <section class="banner-area relative certificate-banner" id="home">	
        <div class="overlay overlay-bg"></div>
        <div class="container">				
            <div class="row">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        {{$certificate->course->title}}				
                    </h1>	
                    <p class="text-white link-nav"><a href="{{ route('home.course.index', ['catalog'=> $certificate->course->catalog->name]) }}">{{$certificate->course->catalog->name}} </a>  <span class="lnr lnr-arrow-right"></span>  <a href="#"> {{$certificate->course->catalog_topic->name}}</a></p>
                </div>	
            </div>
        </div>
    </section>
    <!-- End banner Area -->
    <!-- End banner Area -->	
    <section class="feature-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-feature single-feature-custom">
                        <div class="title">
                            <h4 class="text-uppercase">Certificate of Achievement</h4>
                        </div>
                        <div class="desc-wrap">
                            <div class="w-100">
                                <p>This Certificate is Awarded to</p>
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="image_inner_container">
                                        <img src="{{asset($certificate->customer->profile_picture_path)}}">
                                    </div>
                                </div>
                                <h5 class="font-main text-name font-weight-bold mb-1">{{$certificate->customer->name}}</h5>
                                <h6 class="font-main font-weight-normal">{{$certificate->customer->maskedEmail()}}</h6>
                                <div class="w-100 mt-4rem">
                                    <p class="font-main font-weight-light">
                                        Certificate ID <br>
                                        <b class="font-number font-weight-bold">{{$certificate->hash_id}}</b>
                                    </p>
                                </div>
                            </div>								
                        </div>
                    </div>
                </div>											
            </div>
        </div>	
    </section>
    <!-- Start gallery Area -->
    <section class="gallery-area section-gap">
        <div class="container">
            <div class="row">
                <div class="menu-content pb-40 col-lg-8">
                    <div class="title">
                        <h1 class="mb-10">Course</h1>
                        <p>Course contained in this certificate.</p>
                    </div>
                </div>
                <div class="col-12 mb-100">
                    <a href="{{ route('home.detail.course', ['title'=>$certificate->course->slug_title]) }}">
                        <div class="card">
                            <div class="card-header bg-white border-bottom-0 pb-0">
                                <small class="float-right">Click to open the course</small>
                            </div>
                            <div class="card-body pt-0">
                                <div class="d-flex flex-column text-black">
                                    <h3 class="course-title text-font-family mt-0">
                                        {{$certificate->course->title}}
                                    </h3>
                                </div>
                                <div class="w-100 pb-4">
                                    <div class="course-catalog text-uppercase">
                                        {{$certificate->course->catalog->name}}
                                    </div>
                                    <div class="{{($course_rating->total > 0)? 'text-warning' : ''}} mt-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $course_rating->avg_rating)
                                        <span class="fas fa-star"></span>
                                        @else
                                        @if ($i == ceil($course_rating->avg_rating))
                                        <span class="fas fa-star-half-alt"></span>
                                        @else
                                        <span class="far fa-star"></span>
                                        @endif
                                        @endif
                                        @endfor
                                        <span class="ml-1 text-black text-rating"><b>{{$course_rating->avg_rating}}</b> ({{number_format($course_rating->total, 0, ',', '.')}} ratings)</span>
                                        <span class="mx-2 custom-border-left-2"></span>
                                        <span class="text-black"><b>{{$total_student}}</b> Total students</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="w-100">
                    <h4 class="headline-4-text font-weight-bold pl-3 mb-2">Offered By</h4>
                    <p class="pl-3">{{$certificate->course->title}} is offered by</p>
                    <div class="col-md-7 py-3 d-flex">
                        <div class="mr-4">
                            <img src="{{asset($certificate->course->corporation->path_thumbnail)}}" alt="{{$certificate->course->corporation->name}}" title="{{$certificate->course->corporation->name}}">
                        </div>
                        <div>
                            <h4 class="headline-4-text font-weight-bold">{{$certificate->course->corporation->name}}</h4>
                            <p class="content-offer-by mt-2">{{$certificate->course->corporation->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </section>
    <!-- End gallery Area -->
    
</div>

@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
</script>
@endpush