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
                    <h5 class="">Lesson</h5>
                    <div class="row content-lesson">
                        @foreach ($course->lessons as $lesson)
                        <div class="col-12 content-single">
                            <div class="info-box custom-info-box my-2 pl-0 shadow-none mb-0">
                                <span class="info-box-icon custom-info-box-icon"><i class="far">{{$loop->iteration}}</i></span>
                                
                                <div class="info-box-content custom-info-box-content">
                                    <span class="info-box-text custom-info-box-text pb-1">{{$lesson->title}}</span>
                                    <span class="progress-description text-secondary text-sm">
                                        @if ($lesson->totalVideos()->total > 0)
                                        {{$lesson->totalVideos()->total}} videos (Total {{$lesson->totalVideos()->duration_as_minute}} min){{($lesson->totalbooks() > 0)? ',' : ''}}
                                        @endif
                                        @if ($lesson->totalbooks() > 0)
                                        {{$lesson->totalbooks()}} readings{{($lesson->totalQuizzes() > 0)? ',' : ''}}
                                        @endif 
                                        @if ($lesson->totalQuizzes() > 0)
                                        {{$lesson->totalQuizzes()}} quizzes
                                        @endif
                                    </span>
                                </div>
                                <!-- /.info-box-content custom-info-box-content -->
                            </div>
                        </div>
                        @endforeach
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