
@section('css')
<style>
    .about-banner {
        background: url("{{asset('page_dist/img/banner-bg.jpg')}}") right no-repeat;
        background-size: cover;
        background-position: top;
    }
    .text-font-family {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .sf-arrows .sf-with-ul:after {
        content: none;
    }
    .sf-arrows .sf-with-ul {
        padding-right: 8px;
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
    .card-img-top{
        transition: .5s;
    }
    .card-img-top:hover{
        cursor: pointer;
        box-shadow: 3px 5px 5px #888888;
    }
    .course-content:hover{
        background-color: #fafafa;
        border-radius: 10px;
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
    .course-corporation-name {
        margin-top: 5px;
        margin-bottom: 7px;
    }
    .course-level {
        background-image: -webkit-linear-gradient(90deg, #43afee, #43afee);
        background-image: -moz-linear-gradient(90deg, #43afee, #43afee);
        background-image: linear-gradient(90deg, #43afee, #43afee);
        font-size: 0.75rem;
        width: fit-content;
        text-decoration: none;
        font-weight: 600;
        color: #ffffff;
        padding: 0 0.3rem;
    }
    .hover-black:hover {
        color: #000000;
    }
    .link-container {
        color: inherit;
    }
    .link-container:hover {
        color: inherit;
    }
</style>
@endsection

<div>
    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">	
        <div class="overlay overlay-bg"></div>
        <div class="container">				
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Courses		
                    </h1>	
                    <p class="text-white link-nav"><a href="{{ route('home.index') }}">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="{{ route('home.course.index') }}"> Courses</a></p>
                </div>	
            </div>
        </div>
    </section>
    <!-- End banner Area -->	
    
    <!-- Filter Area -->	
    <section class="review-area py-4">
        <div class="container">
            <div class="row my-3">
                <div class="col-md-12">
                    <p>Filter By:</p>            
                </div>
                <div class="col-md">
                    <select wire:model="level_id" class="form-control">
                        @foreach($levels as $level)
                        <option value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md">
                    <select wire:model="duration" class="form-control">
                        <option value="week">Week</option>
                        <option value="month">Month</option>
                    </select>
                </div>
                <div class="col-md">
                    <select wire:model="skill_id" class="form-control">
                        @foreach($skills as $skill)
                        <option value="{{$skill->id}}">{{$skill->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md">
                    <select wire:model="cat_topic_id" class="form-control">
                        @foreach($cat_topics as $cat_topic)
                        <option value="{{$cat_topic->id}}">{{$cat_topic->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </section>
    <!-- End Filter Area -->	
    
    <div class="container">
        <div class="row my-3">
            @foreach($courses as $course)
            <div class="col-md-12 pt-3 course-content">
                <a class="link-container" href="#">
                    <div class="w-100">
                        <div class="d-flex">
                            <div class="card" style="width: 11rem;height: 12rem">
                                <img class="card-img-top" style="width: 100%;height: 100%;object-fit: cover;" src="{{ asset('page_dist/img/park-background-1.jpg') }}" alt="Card image cap">
                            </div>
                            <div class="ml-3 mt-1 mb-3" id="course-side">
                                <h3 class="course-title text-font-family mb-0">
                                    {{$course->title}}
                                </h3>
                                <div class="w-100 course-corporation-name">
                                    <span class="text-font-family font-weight-normal">{{$course->corporation->name}}</span>
                                </div>
                                <div class="course-catalog text-capitalize mb-30">
                                    {{$course->catalogTopic->name}}
                                </div>
                                <div class="w-100">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                    <span><b>4.8</b> (230.589) | <b>490</b> Total students</span>
                                </div>
                                <div class="course-level rounded text-capitalize text-font-family mt-2">
                                    {{$course->level->name}}
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
    $(document).ready(function() {
    })
    document.addEventListener('livewire:load', function() {
    })
    document.addEventListener('notification:alert', function (event) {
        Swal.fire( {
            icon: 'warning',
            title: 'Oops...',
            text: event.detail.message,
        });
    })
</script>
@endpush
