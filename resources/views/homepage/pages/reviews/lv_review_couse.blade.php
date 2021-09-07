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
    
    .review-banner {
        background: url('{{asset("page_dist/img/review-banner.jpg")}}') center no-repeat;
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
        padding: 90px 15px;
    }
    
    .mt-4rem {
        margin-top: 4rem;
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
    .title-review {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    .text-number-star {
        font-size: 1.1rem;
    }
    .custom-progress-height .progress {
        height: 24px;
    }
    .custom-progress-height td {
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .custom-nav-btn {
        width: 100%;
        /* margin-left: 5px;
        margin-right: 5px;  */
        border-radius: 500px !important;
        border-color: #b8bcbf;
        color: #000000;
    }
    .custom-nav-btn:not(:disabled):not(.disabled).active {
        background-color: #e9ecef;
        border-color: #c3c6ca;
    }
    .custom-nav-btn:hover {
        background-color: #e9ecef;
        border-color: #c3c6ca;
    }
</style>
@endsection

<div>
    <!-- start banner Area -->
    <section class="banner-area relative review-banner" id="home">	
        <div class="overlay overlay-bg"></div>
        <div class="container">				
            <div class="row">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        {{$course->title}}				
                    </h1>	
                    <p class="text-white link-nav"><a href="{{ route('home.course.index', ['catalog'=> $course->catalog->name]) }}">{{$course->catalog->name}} </a>  <span class="lnr lnr-arrow-right"></span>  <a href="#"> {{$course->catalog_topic->name}}</a></p>
                </div>	
            </div>
        </div>
    </section>
    <!-- End banner Area -->
    
    <!-- Start gallery Area -->
    <section class="gallery-area pt-40 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center">
                        <small class="mr-2"><i class="fas fa-chevron-left"></i></small>
                        <a href="{{ route('home.detail.course', ['title'=>$course->slug_title]) }}" class="btn btn-link text-decoration-none">Back to {{$course->title}}</a>
                    </div>
                </div>
                <div class="col-12 mt-50">
                    <h5 class="title-review">Reviews</h5>
                </div>
                <div class="col-12">
                    <div class="w-100">
                        <h5 class="mb-2">Average user rating</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-20">
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
                        <div class="col-md-6">
                            <div class="w-100 custom-progress-height">
                                <table class="w-100">
                                    <tbody>
                                        <tr>
                                            <td class="text-center text-number-star" style="width: 60px">
                                                <span class="text-black">5 <i class="fas fa-star checked text-warning"></i></span>
                                            </td>
                                            <td class="w-75">
                                                <div class="progress rounded-0">
                                                    <div class="progress-bar custom-bg-orange" role="progressbar" style="width: {{$courseDetailRating->percent_5_rating}}%" aria-valuenow="{{$courseDetailRating->percent_5_rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="pl-2 text-black">{{$courseDetailRating->percent_5_rating}}%</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-number-star" style="width: 60">
                                                <span class="text-black">4 <i class="fas fa-star checked text-warning"></i></span>
                                            </td>
                                            <td class="w-75">
                                                <div class="progress rounded-0">
                                                    <div class="progress-bar custom-bg-orange" role="progressbar" style="width: {{$courseDetailRating->percent_4_rating}}%" aria-valuenow="{{$courseDetailRating->percent_4_rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="pl-2 text-black">{{$courseDetailRating->percent_4_rating}}%</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-number-star" style="width: 60">
                                                <span class="text-black">3 <i class="fas fa-star checked text-warning"></i></span>
                                            </td>
                                            <td class="w-75">
                                                <div class="progress rounded-0">
                                                    <div class="progress-bar custom-bg-orange" role="progressbar" style="width: {{$courseDetailRating->percent_3_rating}}%" aria-valuenow="{{$courseDetailRating->percent_3_rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="pl-2 text-black">{{$courseDetailRating->percent_3_rating}}%</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-number-star" style="width: 60">
                                                <span class="text-black">2 <i class="fas fa-star checked text-warning"></i></span>
                                            </td>
                                            <td class="w-75">
                                                <div class="progress rounded-0">
                                                    <div class="progress-bar custom-bg-orange" role="progressbar" style="width: {{$courseDetailRating->percent_2_rating}}%" aria-valuenow="{{$courseDetailRating->percent_2_rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="pl-2 text-black">{{$courseDetailRating->percent_2_rating}}%</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-number-star" style="width: 60">
                                                <span class="text-black" style="padding-left: 3px;">1 <i class="fas fa-star checked text-warning"></i></span>
                                            </td>
                                            <td class="w-75">
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
                </div>
                <div class="col-12 mt-50">
                    <div class="table-responsive pb-20">
                        <div class="d-flex justify-content-between" style="min-width: 690px">
                            <div class="mx-2 w-100"><button wire:click="setReviewAll" class="btn btn-outline-light custom-nav-btn {{($star == 'all')? 'active' : ''}}">All</button></div>
                            <div class="mx-2 w-100"><button wire:click="setReviewStar(5)" class="btn btn-outline-light custom-nav-btn {{($star == 5)? 'active' : ''}}">5 <i class="fas fa-star checked text-warning"></i></button></div>
                            <div class="mx-2 w-100"><button wire:click="setReviewStar(4)" class="btn btn-outline-light custom-nav-btn {{($star == 4)? 'active' : ''}}">4 <i class="fas fa-star checked text-warning"></i></button></div>
                            <div class="mx-2 w-100"><button wire:click="setReviewStar(3)" class="btn btn-outline-light custom-nav-btn {{($star == 3)? 'active' : ''}}">3 <i class="fas fa-star checked text-warning"></i></button></div>
                            <div class="mx-2 w-100"><button wire:click="setReviewStar(2)" class="btn btn-outline-light custom-nav-btn {{($star == 2)? 'active' : ''}}">2 <i class="fas fa-star checked text-warning"></i></button></div>
                            <div class="mx-2 w-100"><button wire:click="setReviewStar(1)" class="btn btn-outline-light custom-nav-btn {{($star == 1)? 'active' : ''}}">1 <i class="fas fa-star checked text-warning"></i></button></div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-capitalize font-weight-normal">
                            @if ($star == "all")
                            {{$star}}
                            @else
                            {{$star}} <i class="fas fa-star checked text-warning"></i>
                            @endif
                        </h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>Sort by:</small> {{($review_filter == 'desc')? 'Latest' : 'Oldest'}} Reviews
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button wire:click="setReviewFilter('latest')" class="dropdown-item" type="button">Latest</button>
                                <button wire:click="setReviewFilter('oldest')" class="dropdown-item" type="button">Oldest</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-12">
                    <div wire:loading.class="d-block" class="card rounded-0 border-0 d-none">
                        <div class="card-body text-center">
                            <i class="fas fa-spinner fa-spin text-primary fa-2x"></i>
                        </div>
                    </div>
                    <div wire:loading.class="d-none" class="card rounded-0 border-0">
                        @forelse ($courseReviews as $rating_item)
                        <div class="card-body px-0">
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
                    </div>
                </div>
                <div class="col-12 mt-4">
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
                            <li id="btn_{{$star}}_page_{{$i}}" class="page-item {{($i == $page)? 'active' : ''}}"><button class="page-link" wire:click="goToPage({{$i}})">{{$i}}</button></li>
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
</section>
<!-- End gallery Area -->

</div>

@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
</script>
@endpush