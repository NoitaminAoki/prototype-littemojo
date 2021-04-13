@extends('homepage.dashboard_layouts.main')

@section('css')
<style>
    .sticky-top {
        top: 56px;
    }
    .content-lesson {
        margin-left: -20px;
        margin-right: -20px;
    }
    .content-single {
        padding-left: 20px;
    }
    .content-active {
        background-color: #dcdcdc;
    }
    .custom-info-box {
        background: inherit;
        cursor: pointer;
        min-height: auto;
    }
    .info-box .custom-info-box-icon {
        width: auto;
        align-items: unset;
        font-size: 1.5rem;
    }
    
    .info-box .custom-info-box-text {
        white-space: normal;
    }
    
    .info-box .custom-info-box-content {
        justify-content: start;
    }
    
    .content-hover:hover {
        cursor: pointer;
        background-color: #000;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="sticky-top">
            <div class="card rounded-0">
                <div class="card-body">
                    <h5 class="">What is AI?</h5>
                    <div class="row content-lesson">
                        <div class="col-12 content-single">
                            <div class="info-box custom-info-box pl-0 shadow-none mb-0">
                                <span class="info-box-icon custom-info-box-icon"><i class="far fa-play-circle"></i></span>
                                
                                <div class="info-box-content custom-info-box-content">
                                    <span class="info-box-text custom-info-box-text pb-1"><strong>Video: </strong> Introduction to AI</span>
                                    <span class="progress-description text-secondary">
                                        7 min
                                    </span>
                                </div>
                                <!-- /.info-box-content custom-info-box-content -->
                            </div>
                        </div>
                        <div class="col-12 content-single content-active">
                            <div class="info-box custom-info-box pl-0 shadow-none mb-0">
                                <span class="info-box-icon custom-info-box-icon"><i class="far fa-play-circle"></i></span>
                                
                                <div class="info-box-content custom-info-box-content">
                                    <span class="info-box-text custom-info-box-text pb-1"><strong>Video: </strong> Machine Learning</span>
                                    <span class="progress-description text-secondary">
                                        7 min
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card rounded-0">
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
@endsection