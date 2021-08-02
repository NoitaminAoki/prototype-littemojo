@section('css')

<style>
    .mb-4rem {
        margin-bottom: 4rem;
    }
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
    .form-select .nice-select {
        height: 38px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding-left: 12px;
    }
    .form-select .nice-select .list {
        border-top: 1px solid #ced4da;
    }
    .single-feature-custom:hover {
        cursor: default;
    }
    .single-feature-custom .title {
        background: rgba(4,9,30,0.7);
    }
    .single-feature-custom:hover .title {
        background: rgba(4,9,30,0.7);
    }
    .feature-area {
        background: #f9f9ff;
    }
    /* .single-feature .title h4 {
        color: #000;
    } */
    .content-loading {
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .content-loading .image-load {
        border-radius: 3px;
        width: 11rem;
        height: 12rem;
    }
    .content-loading .header-load {
        width: 100%;
        height: 50px;
    }
    
    .content-loading .long-load {
        width: 250px;
        height: 23px;
    }
    .content-loading .medium-load {
        width: 190px;
        height: 23px;
    }
    .content-loading .small-load {
        width: 130px;
        height: 23px;
    }
    /* Loading Shimmer */
    .shine {
        background: linear-gradient(to right, rgb(238, 238, 238) 8%, rgb(221, 221, 221) 18%, rgb(238, 238, 238) 33%) 0% 0% / 1000px 104px rgb(235, 236, 237);
        display: inline-block;
        position: relative; 
        
        -webkit-animation-duration: 1s;
        -webkit-animation-fill-mode: forwards; 
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-name: placeholderShimmer;
        -webkit-animation-timing-function: linear;
    }
    .shine-image {
        background-size: 800px 304px !important; 
    }
    
    
    @-webkit-keyframes placeholderShimmer {
        0% {
            background-position: -468px 0;
        }
        
        100% {
            background-position: 468px 0; 
        }
    }
    /* End Loading Shimmer */
    
    .single-feature .custom-widget a {
        font-weight: 500;
    }
    .single-feature:hover .custom-widget a {
        color: #000000;
    }
</style>
@endsection

<div>
    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">	
        <div class="overlay overlay-bg"></div>
        <div class="container">			
            <div class="row d-flex align-items-center justify-content-between" style="height: 500px;">
                <div class="banner-content col-lg-9 col-md-12">
                    <h1 class="text-uppercase">
                        Courses			
                    </h1>
                    <p class="pt-10 pb-10">
                        Complete a series of rigorous courses, tackle hands-on projects, and earn a Specialization Certificate to share with your professional network and potential employers.
                    </p>
                </div>										
            </div>	
            {{-- <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Courses		
                    </h1>	
                    <p class="text-white link-nav"><a href="{{ route('home.index') }}">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="{{ route('home.course.index') }}"> Courses</a></p>
                </div>	
            </div> --}}
        </div>
    </section>
    <!-- End banner Area -->	
    <section class="feature-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-feature single-feature-custom">
                        <div class="title">
                            <h4>Learn Online Courses</h4>
                        </div>
                        <div class="desc-wrap">
                            <div class="w-100 text-left">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-uppercase text-secondary font-weight-normal mb-3">Search</h5>
                                        <div class="form-group">
                                            <label for="name">Course</label>
                                            <input wire:model.defers="input_name" id="input-name" type="text" class="form-control">
                                        </div>
                                        <div class="w-100 text-right">
                                            <button id="btn-clear-search" class="genric-btn link-border medium text-decoration-none">Clear</button>
                                            <button wire:click="searchCourse" class="genric-btn primary medium">Search</button>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <h5 class="text-uppercase text-secondary font-weight-normal mb-3">Popular Catalog</h5>
                                        <div class="widget-wrap">
                                            <div class="single-sidebar-widget tag-cloud-widget custom-widget">
                                                <ul>
                                                    <li><a href="#">Technology</a></li>
                                                    <li><a href="#">Fashion</a></li>
                                                    <li><a href="#">Architecture</a></li>
                                                    <li><a href="#">Fashion</a></li>
                                                    <li><a href="#">Food</a></li>
                                                    <li><a href="#">Technology</a></li>
                                                    <li><a href="#">Lifestyle</a></li>
                                                    <li><a href="#">Art</a></li>
                                                    <li><a href="#">Adventure</a></li>
                                                    <li><a href="#">Food</a></li>
                                                    <li><a href="#">Lifestyle</a></li>
                                                    <li><a href="#">Adventure</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>								
                        </div>
                    </div>
                </div>											
            </div>
        </div>	
    </section>
    
    <!-- Filter Area -->	
    <section class="review-area py-4">
        <div class="container">
            <div class="row my-3">
                <div class="col-md-12">
                    <p>Filter By:</p>            
                </div>
                <div class="col-md">
                    <div class="form-group" wire:ignore>
                        <label>Level</label>
                        <div class="form-select">
                            <select id="level_select" class="nice-select">
                                <option value="" datd-display="">-- All --</option>
                                @foreach($levels as $level)
                                <option value="{{$level->name}}" {{(strcasecmp($level_name, $level->name) == 0)? 'selected' : ''}}>{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group" wire:ignore>
                        <label>Duration</label>
                        <div class="form-select">
                            <select id="duration_select" class="nice-select">
                                <option value="" datd-display="">-- All --</option>
                                <option value="week" {{(strcasecmp($duration_name, 'week') == 0)? 'selected' : ''}}>Week</option>
                                <option value="month" {{(strcasecmp($duration_name, 'month') == 0)? 'selected' : ''}}>Month</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label>Catalog</label>
                        <div wire:ignore>
                            <select id="catalog_select2" name="catalog_id" class="form-control select2" style="width: 100%;" required>
                                @if($catalog_name)
                                <option value=""></option>
                                @else
                                <option selected="selected" value=""></option>
                                @endif
                                @foreach($catalogs as $catalog)
                                <option value="{{$catalog->name}}" {{(strcasecmp($catalog_name, $catalog->name) == 0)? 'selected' : ''}}>{{$catalog->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group" wire:ignore>
                        <label>Topic</label> <small class="ml-1" wire:loading wire:target="changeCatalog" style="display: none"><i class="fas fa-circle-notch fa-spin text-primary"></i></small>
                        <select id="topic_select2" class="form-control select2" style="width: 100%;" name="catalog_topic_id" required>
                            <option selected="selected" value=""></option>
                            <option disabled>Choose Catalog First</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <button wire:click="filterCourse" class="genric-btn primary medium">Filter</button>
                <button id="btn-reset-filter" class="genric-btn link-border medium text-decoration-none">Reset</button>
            </div>
        </div>
    </section>
    <!-- End Filter Area -->	
    
    <div class="container">
        <div wire:loading.class="d-block" wire:target="filterCourse, searchCourse, goToPage" class="row my-3 d-none">
            <div class="col-12">
                <div class="card shadow-sm content-loading">
                    <div class="card-body">
                        <div class="row">
                            <div class="mx-auto" style="padding-right: 15px; padding-left: 15px;">
                                <div class="image-load shine"></div>
                            </div>
                            <div class="col-md">
                                <div class="header-load shine mb-3"></div>
                                <div class="w-100"><div class="long-load shine"></div></div>
                                <div class="w-100"><div class="medium-load shine"></div></div>
                                <div class="w-100"><div class="small-load shine"></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow-sm content-loading">
                    <div class="card-body">
                        <div class="row">
                            <div class="mx-auto" style="padding-right: 15px; padding-left: 15px;">
                                <div class="image-load shine"></div>
                            </div>
                            <div class="col-md">
                                <div class="header-load shine mb-3"></div>
                                <div class="w-100"><div class="long-load shine"></div></div>
                                <div class="w-100"><div class="medium-load shine"></div></div>
                                <div class="w-100"><div class="small-load shine"></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow-sm content-loading">
                    <div class="card-body">
                        <div class="row">
                            <div class="mx-auto" style="padding-right: 15px; padding-left: 15px;">
                                <div class="image-load shine"></div>
                            </div>
                            <div class="col-md">
                                <div class="header-load shine mb-3"></div>
                                <div class="w-100"><div class="long-load shine"></div></div>
                                <div class="w-100"><div class="medium-load shine"></div></div>
                                <div class="w-100"><div class="small-load shine"></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div wire:loading.class="d-none" wire:target="filterCourse, searchCourse, goToPage" class="row my-3">
            @forelse ($courses as $course)
            <div class="col-md-12 pt-3 course-content">
                <a class="link-container" href="{{ route('home.detail.course', ['title'=>$course->slug_title]) }}">
                    <div class="w-100">
                        <div class="d-flex">
                            <div class="card" style="width: 11rem;height: 12rem">
                                <img class="card-img-top" style="width: 100%;height: 100%;object-fit: cover;" src="{{ asset('page_dist/img/park-background-1.jpg') }}" alt="Card image cap">
                            </div>
                            <div class="ml-3 mt-1 mb-3">
                                <h3 class="course-title text-font-family mb-0">
                                    {{$course->title}}
                                </h3>
                                <div class="w-100 course-corporation-name">
                                    <span class="text-font-family font-weight-normal">{{$course->corporation->name}}</span>
                                </div>
                                <div class="course-catalog text-capitalize mb-30">
                                    {{$course->catalog->name}}
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
            @empty
            <div class="col-12">
                <div class="card shadow-sm content-loading">
                    <div class="card-body">
                        <div class="col-12 text-center">
                            @if ($title)
                            <h5 class="font-weight-normal">No result found for "{{$title}}".</h5>
                            @else
                            <h5 class="font-weight-normal">No result found.</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        
        <div class="row mt-4 mb-4rem">
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        @if ($page == 1)
                        <li class="page-item disabled">
                            <button class="page-link" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                        </li>
                        @else
                        <li class="page-item">
                            <button id="btn-prev-page" wire:click="goToPage({{$page-1}})" onclick="console.log('clicked')" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                        </li>
                        @endif
                        @for ($i = 1; $i <= $total_page; $i++)
                        <li class="page-item {{($i == $page)? 'active' : ''}}"><button class="page-link" wire:click="goToPage({{$i}})">{{$i}}</button></li>
                        @endfor
                        @if ($page == $total_page)
                        <li class="page-item disabled">
                            <button class="page-link" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </button>
                        </li>
                        @else
                        <li class="page-item">
                            <button id="btn-next-page" wire:click="goToPage({{$page+1}})" onclick="console.log('clicked')"  class="page-link" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </button>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
    $(document).ready(function() {
        $('.nice-select').niceSelect();
        $('.select2').select2({
            placeholder: '-- All --',
            width: '100%',
            allowClear: true,
        })
        
        $('#catalog_select2').on('change', function (e) {
            var data = $(this).select2("val");
            @this.changeCatalog(data);
        });
        $('#topic_select2').on('change', function (e) {
            var data = $(this).select2("val");
            @this.set("topic_id", data);
        });
        $('#level_select').on('change', function (e) {
            var data = $(this).val();
            @this.set("level_name", data);
        });
        $('#duration_select').on('change', function (e) {
            var data = $(this).val();
            @this.set("duration_name", data);
        });
        $('#btn-reset-filter').on('click', function() {
            $('#level_select').val(null).niceSelect('update');
            $('#duration_select').val(null).niceSelect('update');
            $('#level_select').trigger('change');
            $('#duration_select').trigger('change');
            $('#catalog_select2').val(null).trigger('change');
            $('#topic_select2').val(null).trigger('change');
            @this.filterCourse();
        });
        $('#btn-clear-search').on('click', function() {
            $("#input-name").val("");
            // console.log($("#input-name").val());
            @this.set("input_name", "");
            @this.searchCourse();
        });
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
    document.addEventListener('select2:change', function (event) {
        if(event.detail.data.length > 0) {
            $(event.detail.id).select2().empty();
            $(event.detail.id).select2({
                placeholder: "-- All --",
                width: '100%',
                allowClear: true,
                data: [
                {
                    "id": "",
                    "text": "",
                    "selected": true
                },  
                ...(event.detail.data)
                ]
            });
        } else {
            $(event.detail.id).select2().empty();
            $(event.detail.id).select2({
                placeholder: "-- All --",
                width: '100%',
                allowClear: true,
                data: [
                {
                    "id": "",
                    "text": "",
                    "selected": true
                },  
                {
                    "id": 1,
                    "text": event.detail.text_empty,
                    "disabled": true
                }
                ]
            });
        }
    })
</script>
@endpush
