@section('title', "Dashboard - ".Auth::guard('web')->user()->name)

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
    .text-font-family {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
    .user-banner {
        background: url('{{asset("page_dist/img/user-banner.jpg")}}') center no-repeat;
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
        margin-right: 2rem;
    }
    .about-content {
        padding: 90px 15px;
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
</style>
@endsection

<div>
    <!-- start banner Area -->
    <section class="banner-area relative user-banner" id="home">	
        <div class="overlay overlay-bg"></div>
        <div class="container">				
            <div class="row">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Welcome!				
                    </h1>	
                    <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="gallery.html"> Dashboard</a></p>
                </div>	
            </div>
        </div>
    </section>
    <!-- End banner Area -->
    
    <!-- Start gallery Area -->
    <section class="gallery-area section-gap">
        <div class="container">
            <div class="row">
                <div class="menu-content pb-50 col-lg-8">
                    <div class="title">
                        <h1 class="mb-10">Courses</h1>
                        <p>List of courses that you have purchased.</p>
                    </div>
                </div>
                <div class="col-12">
                    <ul class="nav mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                <h5 class="font-weight-normal">Home</h5>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                <h5 class="font-weight-normal">In Progress</h5>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                                <h5 class="font-weight-normal">Completed</h5>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                @forelse ($purchased_courses as $course)
                                @php
                                $course_progress = $course->getProgress($user_id);
                                $course_access = $course->getAccess($user_id);
                                @endphp
                                <div class="col-12 mb-4">
                                    <div class="card rounded-0 bg-white">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4 order-sm-2 mb-2">
                                                    <img class="w-100 course-img-right" src="{{ asset('page_dist/img/park-background-1.jpg') }}" alt="" aria-hidden="true">
                                                </div>
                                                <div class="col-sm-8 order-sm-1 mb-2">
                                                    <div class="d-flex flex-column text-black">
                                                        <div class="partner-name text-font-family">{{$course->corporation->name}}</div>
                                                        @if($course_access->status_number == 3)
                                                        <h3 class="course-title text-font-family">
                                                            {{$course->title}}
                                                        </h3>
                                                        @else
                                                        <a href="{{ route('home.dashboard.course', ['title'=>$course->slug_title]) }}">
                                                            <h3 class="course-title text-font-family">
                                                                {{$course->title}}
                                                            </h3>
                                                        </a>
                                                        @endif
                                                    </div>
                                                    <div class="w-100">
                                                        <div class="course-catalog text-uppercase">
                                                            {{$course->catalog->name}}
                                                        </div>
                                                        <div class="text-warning mt-4">
                                                            <span class="fas fa-star checked"></span>
                                                            <span class="fas fa-star checked"></span>
                                                            <span class="fas fa-star checked"></span>
                                                            <span class="fas fa-star-half-alt checked"></span>
                                                            <span class="far fa-star"></span>
                                                            <span class="ml-1 text-black text-rating">4.6</span>
                                                            <span class="mx-2 border-left border-right"></span>
                                                            <span class="ml-1 text-black text-rating">86,528 ratings</span>
                                                        </div>
                                                    </div>
                                                    <div class="w-100 mt-4rem">
                                                        @if ($course_access->status_number == 2)
                                                        @if ($course_progress->percent == 100)
                                                        <span class="text-font-family text-lg-left d-block">Status: <b class="badge badge-primary text-uppercase">Completed</b></span>
                                                        @else
                                                        <span class="text-font-family text-lg-left d-block">Status: <b class="badge badge-success text-uppercase">In progress</b></span>
                                                        @endif
                                                        <span class="text-font-family text-lg-left d-block">Finish Date: <b class="text-danger">{{date('d F Y', strtotime($course->getDateTransaction($user_id)->end_date))}}</b></span>
                                                        @elseif($course_access->status_number == 1)
                                                        <span class="text-font-family text-lg-left d-block">Status: <b class="badge badge-secondary text-uppercase">not yet Accessible</b></span>
                                                        <span class="text-font-family text-lg-left d-block">Start Date: <b class="text-primary">{{date('d F Y', strtotime($course->getDateTransaction($user_id)->start_date))}}</b></span>
                                                        @elseif($course_access->status_number == 3)
                                                        <span class="text-font-family text-lg-left d-block">Status: <b class="badge badge-danger text-uppercase">{{$course_access->status}}</b></span>
                                                        <span class="text-font-family text-lg-left d-block">Finish Date: <b class="text-danger">{{date('d F Y', strtotime($course->getDateTransaction($user_id)->end_date))}}</b></span>
                                                        @endif
                                                    </div>
                                                    <div class="w-100 mt-2">
                                                        <div class="d-flex justify-content-between align-items-end mb-1">
                                                            <small class="text-secondary"><b>PROGRESS</b> {{$course_progress->percent}}% complete</small>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="{{$course_progress->percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$course_progress->percent}}%">
                                                                <span class="sr-only">{{$course_progress->percent}}% Complete</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    @if($course_access->status_number == 3)
                                                    <div class="w-100 text-right mt-4">
                                                        <button class="custom-btn-capsule btn-course-expired btn btn-secondary btn-sm" style="cursor: not-allowed"><i class="fas fa-ban"></i></button>
                                                    </div>
                                                    @else
                                                    <div class="w-100 text-right mt-4">
                                                        <a href="{{ route('home.dashboard.course', ['title'=>$course->slug_title]) }}" class="custom-btn-capsule btn btn-primary btn-sm"><i class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="card-footer bg-white  text-right">
                                        </div> --}}
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="card shadow-sm content-loading">
                                        <div class="card-body">
                                            <div class="col-12 text-center">
                                                <h5 class="font-weight-normal">No result.</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                                @forelse ($inprogress_courses as $course)
                                @php
                                $course_2_progress = $course->getProgress($user_id);
                                @endphp
                                <div class="col-12 mb-4">
                                    <div class="card rounded-0 bg-white">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4 order-sm-2 mb-2">
                                                    <img class="w-100 course-img-right" src="{{ asset('page_dist/img/park-background-1.jpg') }}" alt="" aria-hidden="true">
                                                </div>
                                                <div class="col-sm-8 order-sm-1 mb-2">
                                                    <div class="d-flex flex-column text-black">
                                                        <div class="partner-name text-font-family">{{$course->corporation->name}}</div>
                                                        <a href="{{ route('home.dashboard.course', ['title'=>$course->slug_title]) }}">
                                                            <h3 class="course-title text-font-family">
                                                                {{$course->title}}
                                                            </h3>
                                                        </a>
                                                    </div>
                                                    <div class="w-100">
                                                        <div class="course-catalog text-uppercase">
                                                            {{$course->catalog->name}}
                                                        </div>
                                                        <div class="text-warning mt-4">
                                                            <span class="fas fa-star checked"></span>
                                                            <span class="fas fa-star checked"></span>
                                                            <span class="fas fa-star checked"></span>
                                                            <span class="fas fa-star-half-alt checked"></span>
                                                            <span class="far fa-star"></span>
                                                            <span class="ml-1 text-black text-rating">4.6</span>
                                                            <span class="mx-2 border-left border-right"></span>
                                                            <span class="ml-1 text-black text-rating">86,528 ratings</span>
                                                        </div>
                                                    </div>
                                                    <div class="w-100 mt-4rem">
                                                        <span class="text-font-family text-lg-left d-block">Status: <b class="badge badge-success text-uppercase">In progress</b></span>
                                                        <span class="text-font-family text-lg-left d-block">Finish Date: <b class="text-danger">{{date('d F Y', strtotime($course->getDateTransaction($user_id)->end_date))}}</b></span>
                                                    </div>
                                                    <div class="w-100 mt-2">
                                                        <div class="d-flex justify-content-between align-items-end mb-1">
                                                            <small class="text-secondary"><b>PROGRESS</b> {{$course_2_progress->percent}}% complete</small>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="{{$course_2_progress->percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$course_2_progress->percent}}%">
                                                                <span class="sr-only">{{$course_2_progress->percent}}% Complete</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="w-100 text-right mt-4">
                                                        <a href="{{ route('home.dashboard.course', ['title'=>$course->slug_title]) }}" class="custom-btn-capsule btn btn-primary btn-sm"><i class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="card-footer bg-white  text-right">
                                        </div> --}}
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="card shadow-sm content-loading">
                                        <div class="card-body">
                                            <div class="col-12 text-center">
                                                <h5 class="font-weight-normal">No result.</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row">
                                @forelse ($completed_courses as $course)
                                <div class="col-12 mb-4">
                                    <div class="card rounded-0 bg-white">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4 order-sm-2 mb-2">
                                                    <img class="w-100 course-img-right" src="{{ asset('page_dist/img/park-background-1.jpg') }}" alt="" aria-hidden="true">
                                                </div>
                                                <div class="col-sm-8 order-sm-1 mb-2">
                                                    <div class="d-flex flex-column text-black">
                                                        <div class="partner-name text-font-family">{{$course->corporation->name}}</div>
                                                        <a href="{{ route('home.dashboard.course', ['title'=>$course->slug_title]) }}">
                                                            <h3 class="course-title text-font-family">
                                                                {{$course->title}}
                                                            </h3>
                                                        </a>
                                                    </div>
                                                    <div class="w-100">
                                                        <div class="course-catalog text-uppercase">
                                                            {{$course->catalog->name}}
                                                        </div>
                                                        <div class="text-warning mt-4">
                                                            <span class="fas fa-star checked"></span>
                                                            <span class="fas fa-star checked"></span>
                                                            <span class="fas fa-star checked"></span>
                                                            <span class="fas fa-star-half-alt checked"></span>
                                                            <span class="far fa-star"></span>
                                                            <span class="ml-1 text-black text-rating">4.6</span>
                                                            <span class="mx-2 border-left border-right"></span>
                                                            <span class="ml-1 text-black text-rating">86,528 ratings</span>
                                                        </div>
                                                    </div>
                                                    <div class="w-100 mt-4rem">
                                                        <span class="text-font-family text-lg-left d-block">Status: <b class="badge badge-primary text-uppercase">Completed</b></span>
                                                        <span class="text-font-family text-lg-left d-block">Finish Date: <b class="text-danger">{{date('d F Y', strtotime($course->getDateTransaction($user_id)->end_date))}}</b></span>
                                                    </div>
                                                    <div class="w-100 mt-2">
                                                        <div class="d-flex justify-content-between align-items-end mb-1">
                                                            <small class="text-secondary"><b>PROGRESS</b> 100% complete</small>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                <span class="sr-only">100% Complete</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="w-100 text-right mt-4">
                                                        <a href="{{ route('home.dashboard.course', ['title'=>$course->slug_title]) }}" class="custom-btn-capsule btn btn-primary btn-sm"><i class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="card-footer bg-white  text-right">
                                        </div> --}}
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="card shadow-sm content-loading">
                                        <div class="card-body">
                                            <div class="col-12 text-center">
                                                <h5 class="font-weight-normal">No result.</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                            </div>
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
    $(document).on('click', '.btn-course-expired', function() {
        Swal.fire({
            icon: 'error',
            title: 'Failed!',
            text: 'Your course has ended.',
        });
    });  
</script>
@endpush