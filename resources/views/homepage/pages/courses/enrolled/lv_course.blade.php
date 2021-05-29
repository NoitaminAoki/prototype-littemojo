@section('title', 'Course')

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
        border-bottom: 1px solid #fff;
        border-top: 1px solid #fff;
    }
    .content-active {
        background-color: #dcdcdc;
    }
    .part-content-action {
        cursor: pointer;
    }
    .custom-info-box {
        background: inherit;
        min-height: auto;
    }
    .info-box .custom-info-box-icon {
        width: auto;
        align-items: unset;
        font-size: 1.5rem;
    }
    
    .info-box .custom-info-box-icon-single {
        width: auto;
        font-size: 1.3rem;
    }
    
    .info-box .custom-info-box-text {
        white-space: normal;
    }
    
    .info-box .custom-info-box-content {
        justify-content: start;
    }
    
    .info-box .custom-info-box-text-single {
        font-size: 0.875rem;
    }
    
    .content-hover:hover {
        cursor: pointer;
        background-color: #dcdcdc;
    }

    .content-hover-not-allowed:hover {
        cursor: not-allowed;
        background-color: #dcdcdc;
    }
    .text-font-family {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .text-list {
        font-size: 0.875rem;
        line-height: 1.5rem;
        font-weight: normal;
    }
    
    /* imported */
    .custom-info-box-icon-circle-single {
        -webkit-box-align: center;
        -webkit-box-pack: center;
        width: 22px !important;
        height: 22px !important;
        border: 2.2px solid rgb(225, 225, 225);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        font-size: 0.7rem;
    }
    
    .custom-text-light-green {
        color: #20c997!important;
    }
    .custom-border-light-green {
        border-color: #20c997!important;
    }
    .custom-btn-capsule {
        width: 70px;
        border-radius: 500px !important;
        text-align: end;
    }
    
    .not-allowed {
        cursor: not-allowed;
    }
</style>
@endsection

@php
    $is_clickable = true;
@endphp

<div class="row">
    <div class="col-md-3">
        <div class="sticky-top">
            <div class="card rounded-0">
                <div class="card-body">
                    <h5 class="">Lesson</h5>
                    <div class="row content-lesson">
                        @foreach ($course->lessons as $lesson)
                        <div class="col-12 content-single {{($is_clickable)? 'content-hover' : 'content-hover-not-allowed'}} {{($lesson->id == $selected_lesson->id)? 'content-active' : ''}}">
                            <div class="info-box {{($is_clickable)? 'part-content-action' : 'not-allowed'}} custom-info-box my-2 pl-0 shadow-none mb-0" data-id="{{$lesson->id}}">
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
                                    @if ($is_clickable && $lesson->isFinished(Auth::guard('web')->user()->id))
                                        <div class="w-100">
                                            <hr class="mb-0">
                                            <small class="text-success">[COMPLETED]</small>
                                        </div>
                                    @else
                                        @php
                                            $is_clickable = false;
                                        @endphp
                                    @endif
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
                <div class="overlay-wrapper">
                    <div wire:loading.flex wire:target="setLesson" class="overlay modal-overlay" style="display: none;"><i class="fas fa-3x fa-sync-alt fa-spin"></i></div>
                    <h5>{{$selected_lesson->title}}</h5>
                    <p class="mb-4">{{$selected_lesson->description}}</p>
                    
                    <div class="w-100">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('home.dashboard.course.lesson.index', ['title'=>$slug_course_name, 'lesson_id' => $selected_lesson->id]) }}" class="custom-btn-capsule btn btn-primary"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="info-box custom-info-box pl-0 shadow-none mb-0">
                        <span class="info-box-icon custom-info-box-icon-single text-primary"><i class="far fa-play-circle"></i></span>
                        
                        <div class="info-box-content">
                            <span class="info-box-text custom-info-box-text-single font-weight-bold text-font-family"> {{$selected_lesson->totalVideos()->total}} videos</span>
                        </div>
                        <!-- /.info-box-content custom-info-box-content -->
                    </div>
                    <ul class="list-unstyled">
                        @foreach ($selected_lesson->videos as $video)
                        <li class="text-font-family my-4 text-list">{{$video->title}} <span class="ml-2">{{floor($video->duration/60)}}m</span></li>
                        @endforeach
                    </ul>
                    
                    <hr>
                    
                    <div class="info-box custom-info-box pl-0 shadow-none mb-0">
                        <span class="custom-info-box-icon-circle-single custom-border-light-green rounded-circle custom-text-light-green"><i class="fas fa-book-open"></i></span>
                        
                        <div class="info-box-content">
                            <span class="info-box-text custom-info-box-text-single font-weight-bold text-font-family"> {{$selected_lesson->totalBooks()}} readings</span>
                        </div>
                        <!-- /.info-box-content custom-info-box-content -->
                    </div>
                    <ul class="list-unstyled">
                        @foreach ($selected_lesson->books as $book)
                        <li class="text-font-family my-4 text-list">{{$book->title}}</li>
                        @endforeach
                    </ul>
                    
                    <hr>
                    
                    <div class="info-box custom-info-box pl-0 shadow-none mb-0">
                        <span class="info-box-icon custom-info-box-icon-single text-indigo"><i class="far fa-question-circle"></i></span>
                        
                        <div class="info-box-content">
                            <span class="info-box-text custom-info-box-text-single font-weight-bold text-font-family"> {{$selected_lesson->totalQuizzes()}} practice exercises</span>
                        </div>
                        <!-- /.info-box-content custom-info-box-content -->
                    </div>
                    <ul class="list-unstyled">
                        @foreach ($selected_lesson->quizzes as $quiz)
                        <li class="text-font-family my-4 text-list">{{$quiz->title}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).on('click', '.part-content-action', function() {
        $('.content-lesson div.content-active').removeClass('content-active');
        $(this).parents('div.col-12').addClass('content-active');
        var lesson_id = $(this).attr('data-id');
        @this.setLesson(lesson_id);
    });
</script>
@endpush