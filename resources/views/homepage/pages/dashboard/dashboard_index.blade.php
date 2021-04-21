@section('title', "Dashboard - ".Auth::guard('web')->user()->name)

@section('css')
<style>
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
                                <div class="col-12">
                                    <div class="card rounded-0">
                                        <div class="card-body">
                                            test
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                    </div>
                </div>
            </div>
        </div>	
    </section>
    <!-- End gallery Area -->
</div>

@push('script')
<script>
</script>
@endpush