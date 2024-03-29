@section('title', "{$course->title} - {$lesson->title}")
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
<!-- Theme Forest -->
<link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet"/>
<style>
    .sticky-top {
        top: 56px;
    }
    .content-lesson {
        margin-left: -20px;
        margin-right: -20px;
        /* height: 73.6vh;
        overflow: auto; */
    }
    .content-single {
        padding-left: 20px;
        border-bottom: 1px solid #fff;
        border-top: 1px solid #fff;
        min-height: 61px;
    }
    .part-content-action {
        cursor: pointer;
    }
    .content-active {
        background-color: #dcdcdc;
    }
    .custom-info-box {
        background: inherit;
        cursor: pointer;
        min-height: auto;
        height: 100%;
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
        background-color: #dcdcdc;
    }
    
    /* imported */
    .custom-info-box-icon-circle-single {
        -webkit-box-align: center;
        -webkit-box-pack: center;
        width: 24px !important;
        height: 24px !important;
        border: 2.3px solid #212529;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        font-size: 0.8rem;
    }
    .custom-icon-size {
        font-size: 1.3rem;
    }
    .text-font-family {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    #selected_item {
        min-height: 150px;
    }
    .object_iframe_pdf {
        width: 100%;
        min-height: 80vh;
    }

    .not-allowed {
        cursor: not-allowed;
    }
</style>
@endsection

@section('breadcrumb-navbar')
<div class="d-flex justify-content-between">
    <ol class="breadcrumb mb-0" style="background-color: inherit">
        <li class="breadcrumb-item"><a href="{{ route('home.dashboard.course', ['title' => $course->slug_title]) }}">{{$course->title}}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('home.dashboard.course.lesson', ['title' => $course->slug_title]) }}">{{$lesson->title}}</a></li>
        <li id="breadcrumb_title_item" class="breadcrumb-item active" aria-current="page">{{$selected_item[$selected_item['type']]->title}}</li>
    </ol>
    <div class="d-flex align-items-center">
        <button id="btn_prev_item" class="btn">Prev</button>
        @if ($selected_item['type'] == $last_item['type'] && $selected_item[$selected_item['type']]->id == $last_item['id'])
        <button id="btn_next_item" class="btn" style="display: none;">Next</button>
        <button id="btn_finish_lesson" class="btn">Finish</button>
        @else
        <button id="btn_next_item" class="btn">Next</button>
        <button id="btn_finish_lesson" class="btn" style="display: none;">Finish</button>
        @endif
    </div>
</div>
@endsection
@php
    $next_item_allowed = true;
@endphp
<div class="row">
    <div class="col-md-3">
        <div class="card rounded-0">
            <div class="card-body">
                <h5 class="">{{$lesson->title}}</h5>
                <div id="content_lesson" class="row content-lesson">
                    @foreach ($lesson->videos as $video)

                    @php
                        $is_finished = $video->isFinished(Auth::guard('web')->user()->id);
                    @endphp

                    <div id="items_video_{{$video->id}}" data-status="{{($loop->iteration == 1)? 'video_first' : (($loop->last)? 'video_last' : '') }}" class="col-12 content-single content-hover {{($video->id == $selected_item['video']['id'])? 'content-active' : ''}}">
                        <div class="info-box custom-info-box pl-0 shadow-none mb-0 {{($is_finished)? 'part-content-action' : ($next_item_allowed)? 'part-content-action' : 'not-allowed'}}" data-id="{{$video->id}}" data-type="video">
                            @if ($is_finished)
                            <span class="info-box-icon custom-info-box-icon text-success"><i class="fas fa-check-circle"></i></span>
                            @else
                            @php
                                $next_item_allowed = false;
                            @endphp
                            <span class="info-box-icon custom-info-box-icon"><i class="far fa-play-circle"></i></span>
                            @endif
                            
                            <div class="info-box-content custom-info-box-content">
                                <span class="info-box-text custom-info-box-text pb-1"><strong>Video: </strong> {{$video->title}}</span>
                                <span class="progress-description text-secondary">
                                    {{floor($video->duration/60)}} min
                                </span>
                            </div>
                            <!-- /.info-box-content custom-info-box-content -->
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12">
                        <hr>
                    </div>
                    @foreach ($lesson->books as $book)
                    @php
                        $is_finished = $book->isFinished(Auth::guard('web')->user()->id);
                    @endphp
                    <div id="items_book_{{$book->id}}" data-status="{{($loop->iteration == 1)? 'book_first' : (($loop->last)? 'book_last' : '') }}" class="col-12 content-single content-hover {{($book->id == $selected_item['book']['id'])? 'content-active' : ''}}">
                        <div class="info-box custom-info-box pl-0 shadow-none mb-0 {{($is_finished)? 'part-content-action' : ($next_item_allowed)? 'part-content-action' : 'not-allowed'}}" data-id="{{$book->id}}" data-type="book">
                            @if ($is_finished)
                            <span class="info-box-icon custom-info-box-icon text-success"><i class="fas fa-check-circle"></i></span>
                            @else
                            @php
                                $next_item_allowed = false;
                            @endphp
                            <span class="custom-info-box-icon-circle-single rounded-circle"><i class="fas fa-book-open"></i></span>
                            @endif
                            <div class="info-box-content custom-info-box-content">
                                <span class="info-box-text custom-info-box-text pb-1"><strong>Reading: </strong> {{$book->title}}</span>
                            </div>
                            <!-- /.info-box-content custom-info-box-content -->
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12">
                        <hr>
                    </div>
                    @foreach ($lesson->quizzes as $quiz)
                    @php
                        $is_finished = $quiz->isFinished(Auth::guard('web')->user()->id);
                    @endphp
                    <div id="items_quiz_{{$quiz->id}}" data-status="{{($loop->iteration == 1)? 'quiz_first' : (($loop->last)? 'quiz_last' : '') }}" class="col-12 content-single content-hover {{($quiz->id == $selected_item['quiz']['id'])? 'content-active' : ''}}">
                        <div class="info-box custom-info-box pl-0 shadow-none mb-0 {{($is_finished)? 'part-content-action' : ($next_item_allowed)? 'part-content-action' : 'not-allowed'}}" data-id="{{$quiz->id}}" data-type="quiz">
                            
                            @if ($is_finished)
                            <span class="info-box-icon custom-info-box-icon text-success"><i class="fas fa-check-circle"></i></span>
                            @else
                            @php
                                $next_item_allowed = false;
                            @endphp
                            <span class="info-box-icon custom-info-box-icon"><i class="far fa-question-circle"></i></span>
                            @endif
                            <div class="info-box-content custom-info-box-content">
                                <span class="info-box-text custom-info-box-text pb-1"><strong>Quiz: </strong> {{$quiz->title}}</span>
                            </div>
                            <!-- /.info-box-content custom-info-box-content -->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card rounded-0">
            <div id="selected_item" data-id="{{$selected_item[$selected_item['type']]->id}}" data-type="{{$selected_item['type']}}" class="card-body">
                <div class="overlay-wrapper">
                    <div wire:loading.flex wire:target="setItem, finishLesson, nextItem, resetQuiz" class="overlay modal-overlay" style="display: none;"><i class="fas fa-3x fa-sync-alt fa-spin"></i></div>
                    @if ($selected_item['type'] == 'video')
                    <div id="test_div" class="w-100">
                        <video id="video_{{$selected_item['video']->id}}" class="video-js vjs-theme-forest" controls preload="meta-data" data-setup='{"fluid": true}'>
                            <source src="{{ route('home.asset.lesson.videos', ['uuid'=>$selected_item['video']->uuid]) }}" type="video/mp4" />
                                <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                            </p>
                        </video>
                    </div>
                    <div class="w-100 mt-2">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h5 class="mt-0 mb-0 text-font-family">{{$selected_item['video']->title}}</h5>
                            </div>
                            <div>
                                <button id="btn_like" data-parent-id="{{$course->id}}" data-sub-parent-id="{{$lesson->id}}" data-id="{{$selected_item['video']->id}}" data-type="video" class="btn {{ ($selected_item['video']->isLiked(Auth::guard('web')->user()->id))? 'text-primary' : '' }}"><i class="custom-icon-size far fa-thumbs-up"></i></button>
                                <button id="btn_dislike" data-parent-id="{{$course->id}}" data-sub-parent-id="{{$lesson->id}}" data-id="{{$selected_item['video']->id}}" data-type="video" class="btn {{ ($selected_item['video']->isDisliked(Auth::guard('web')->user()->id))? 'text-primary' : '' }}"><i class="custom-icon-size far fa-thumbs-down"></i></button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                    @elseif($selected_item['type'] == 'book')
                    <div class="w-100">
                        <p class="text-sm">Reading file
                            <b class="d-block"><a href="{{ route('home.asset.lesson.books', ['uuid'=>$selected_item['book']->uuid, 'filename' => \Str::slug($selected_item['book']->title).'.pdf']) }}" target="_blank" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> {{\Str::slug($selected_item['book']->title)}}.pdf</a></b>
                        </p>
                        <small class="text-danger">*if pdf not shown, click the download button</small>
                        <br>
                        <a href="{{ route('home.asset.lesson.books', ['uuid'=>$selected_item['book']->uuid, 'filename' => \Str::slug($selected_item['book']->title).'.pdf']) }}" target="_blank" class="btn btn-sm btn-warning">Download File</a>
                    </div>
                    <div class="w-100 mt-2 mb-4">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h5 class="mt-0 mb-0 text-font-family">{{$selected_item['book']->title}}</h5>
                            </div>
                            <div>
                                <button id="btn_like" data-parent-id="{{$course->id}}" data-sub-parent-id="{{$lesson->id}}" data-id="{{$selected_item['book']->id}}" data-type="book" class="btn {{ ($selected_item['book']->isLiked(Auth::guard('web')->user()->id))? 'text-primary' : '' }}"><i class="custom-icon-size far fa-thumbs-up"></i></button>
                                <button id="btn_dislike" data-parent-id="{{$course->id}}" data-sub-parent-id="{{$lesson->id}}" data-id="{{$selected_item['book']->id}}" data-type="book" class="btn {{ ($selected_item['book']->isDisliked(Auth::guard('web')->user()->id))? 'text-primary' : '' }}"><i class="custom-icon-size far fa-thumbs-down"></i></button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                    <object class="object_iframe_pdf" data="{{ route('home.asset.lesson.books', ['uuid'=>$selected_item['book']->uuid, 'filename' => \Str::slug($selected_item['book']->title).'.pdf']) }}#zoom=50" type="application/pdf">
                        <iframe src="{{ route('home.asset.lesson.books', ['uuid'=>$selected_item['book']->uuid, 'filename' => \Str::slug($selected_item['book']->title).'.pdf']) }}#zoom=50" height="100%" width="100%"></iframe>
                    </object>
                    @elseif($selected_item['type'] == 'quiz')
                    <div class="w-100 mt-2">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h5 class="mt-0 mb-0 text-font-family">{{$selected_item['quiz']->title}}</h5>
                            </div>
                            <div>
                                <button id="btn_like" data-parent-id="{{$course->id}}" data-sub-parent-id="{{$lesson->id}}" data-id="{{$selected_item['quiz']->id}}" data-type="quiz" class="btn {{ ($selected_item['quiz']->isLiked(Auth::guard('web')->user()->id))? 'text-primary' : '' }}"><i class="custom-icon-size far fa-thumbs-up"></i></button>
                                <button id="btn_dislike" data-parent-id="{{$course->id}}" data-sub-parent-id="{{$lesson->id}}" data-id="{{$selected_item['quiz']->id}}" data-type="quiz" class="btn {{ ($selected_item['quiz']->isDisliked(Auth::guard('web')->user()->id))? 'text-primary' : '' }}"><i class="custom-icon-size far fa-thumbs-down"></i></button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                    
                    <div class="w-100">
                        <div class="row">
                            @php
                                $user_score = $selected_item['quiz']->userScore(Auth::guard('web')->user()->id);
                            @endphp
                            @if ($user_score)
                            <div class="col-md-8">
                                <div class="mr-4">
                                    <h6 class="text-font-family text-lg text-center">Total Score</h6>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            @if ($user_score->is_pass)
                                            <h6 class="text-font-family mb-0">Congratulation! You passed!</h6>
                                            @else
                                            <h6 class="text-font-family mb-0">Sorry, you failed!</h6>
                                            @endif
                                            <small class="text-secondary"><b>TO PASS</b> {{$selected_item['quiz']->minimum_score}}% or higher</small>
                                        </div>
                                        <h4 class="text-font-family text-xl {{($user_score->is_pass)? 'text-success' : 'text-danger'}}">{{$user_score->score}}%</h4>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar {{($user_score->is_pass)? 'bg-teal' : 'bg-red'}}" role="progressbar" aria-valuenow="{{$user_score->score}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$user_score->score}}%">
                                            <span class="sr-only">{{$user_score->score}}% Complete</span>
                                        </div>
                                    </div>
                                    <div class="w-100 mt-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="text-muted">
                                                    <p class="text-sm">Correct Answer
                                                        <b class="d-block">{{$user_score->right_answer}}</b>
                                                    </p>
                                                    <p class="text-sm">Wrong Answer
                                                        <b class="d-block">{{$user_score->wrong_answer}}</b>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="text-muted">
                                                    <p class="text-sm">Status
                                                    </p>
                                                    @if ($user_score->is_pass)
                                                    <h4 class="text-success">PASS</h4>
                                                    @else
                                                    <h4 class="text-danger">FAIL</h4>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-md-8">
                                <div class="mr-4">
                                    <h6 class="text-font-family text-lg text-center">Total Score</h6>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-font-family mb-0">Complete Your Quiz First</h6>
                                            <small class="text-secondary">the score will be calculated after the quiz is finished</small>
                                        </div>
                                        <h4 class="text-font-family text-xl text-secondary">0%</h4>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-red" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            <span class="sr-only">0% Complete</span>
                                        </div>
                                    </div>
                                    <div class="w-100 mt-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="text-muted">
                                                    <p class="text-sm">Correct Answer
                                                        <b class="d-block">N/A</b>
                                                    </p>
                                                    <p class="text-sm">Wrong Answer
                                                        <b class="d-block">N/A</b>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="text-muted">
                                                    <p class="text-sm">Status
                                                    </p>
                                                    <h4 class="">N/A</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-muted">
                                            <p class="text-sm">Total Question
                                                <b class="d-block">{{$selected_item['quiz']->totalQuestion()}}</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted">
                                            <p class="text-sm">Correct Answer <small>(Minimum)</small>
                                                <b class="d-block">{{ceil($selected_item['quiz']->totalQuestion()/100 * $selected_item['quiz']->minimum_score)}}</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="post">
                                            <div class="user-block">
                                              <h6 class="text-font-family">Progress</h6>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="progress progress-sm w-100">
                                                @php
                                                    $progress_works = $selected_item['quiz']->progressWork(Auth::guard('web')->user()->id);
                                                @endphp
                                                @if ($progress_works <= 20)
                                                <div class="progress-bar bg-red" role="progressbar" aria-volumenow="{{$progress_works}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$progress_works}}%">
                                                </div>
                                                @elseif($progress_works <= 40)
                                                <div class="progress-bar bg-orange" role="progressbar" aria-volumenow="{{$progress_works}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$progress_works}}%">
                                                </div>
                                                @elseif($progress_works <= 60)
                                                <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{$progress_works}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$progress_works}}%">
                                                </div>
                                                @elseif($progress_works <= 100)
                                                <div class="progress-bar bg-teal" role="progressbar" aria-volumenow="{{$progress_works}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$progress_works}}%">
                                                </div>
                                                @endif
                                            </div>
                                            <small>
                                                {{$progress_works}}% Complete
                                            </small>
                                          </div>
                                          <div class="post">
                                            @if ($user_score)
                                            <a href="{{ route('home.dashboard.course.lesson.quiz', ['title'=>$course->slug_title, 'lesson_id' => $lesson->id, 'quiz_id' => $selected_item['quiz']->id]) }}" target="_blank" class="btn btn-success btn-block">
                                                See Result
                                            </a>
                                            @if (!$user_score->is_pass)
                                            <button id="btn_requiz" data-id="{{$user_score->id}}" target="_blank" class="btn btn-link btn-block mt-2">
                                                Re-quiz
                                            </button>
                                            @endif
                                            @else
                                            @if ($progress_works > 0)
                                            <a href="{{ route('home.dashboard.course.lesson.quiz', ['title'=>$course->slug_title, 'lesson_id' => $lesson->id, 'quiz_id' => $selected_item['quiz']->id]) }}" target="_blank" class="btn btn-warning btn-block">
                                                Resume Quiz
                                            </a>
                                            @else
                                            <a href="{{ route('home.dashboard.course.lesson.quiz', ['title'=>$course->slug_title, 'lesson_id' => $lesson->id, 'quiz_id' => $selected_item['quiz']->id]) }}" target="_blank" class="btn btn-primary btn-block">
                                                Start Quiz
                                            </a>
                                            @endif
                                            @endif
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
<script>
    $(document).on('click', '#btn_requiz', function() {
        var score_id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure want to re-quiz?",
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                @this.resetQuiz(score_id);
            }
        });
    })

    $(document).on('click', '#btn_like', function() {
        // $('#test_div').attr('wire:ignore', '');
        var data_course_id = $(this).attr('data-parent-id');
        var data_lesson_id = $(this).attr('data-sub-parent-id');
        var data_id = $(this).attr('data-id');
        var data_type = $(this).attr('data-type');
        $(this).addClass('text-primary');
        $('#btn_dislike').removeClass('text-primary');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var data = {
            _token: CSRF_TOKEN, 
            course_id: data_course_id, 
            lesson_id:data_lesson_id,
            id: data_id,
            type: data_type,
            like: true, 
            message:`Data ID: ${data_id}, Data Type: ${data_type}`
        };
        $.ajax({
            url: '{{route("ajax.request.lesson.rating")}}',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function (data) { 
                console.info(data); 
            }
        }); 
    })

    $(document).on('click', '#btn_dislike', function() {
        var data_course_id = $(this).attr('data-parent-id');
        var data_lesson_id = $(this).attr('data-sub-parent-id');
        var data_id = $(this).attr('data-id');
        var data_type = $(this).attr('data-type');
        $(this).addClass('text-primary');
        $('#btn_like').removeClass('text-primary');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var data = {
            _token: CSRF_TOKEN, 
            course_id: data_course_id, 
            lesson_id:data_lesson_id,
            id: data_id,
            type: data_type,
            like: false, 
            message:`Data ID: ${data_id}, Data Type: ${data_type}`
        };
        $.ajax({
            url: '{{route("ajax.request.lesson.rating")}}',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function (data) { 
                console.info(data); 
            }
        }); 
    })

    function stopMediaPlayer(element_id) {
        var video = document.getElementById(element_id);
        if(video) {
            videojs(video).pause();
        }
    }

    $('#btn_prev_item').on('click', function() {
        var selected_item = $('#selected_item');
        var item_id = selected_item.attr('data-id');
        var item_type = selected_item.attr('data-type');
        var prev_item_id = (parseInt(item_id)-1);
        if(item_type == "video") {
            stopMediaPlayer(`video_${item_id}`);
        }
        function checkItem(id, type) {
            let item = $(`#content_lesson #items_${type}_${id}`);
            if(item.length > 0) {
                return item
            } else {
                return false
            }
        }
        var get_item = checkItem(prev_item_id, item_type);
        if(get_item) {
            @this.setItem({id: prev_item_id, type: item_type});
        } else {
            let prev_item = "";
            let prev_item_type = "";
            if(item_type == "quiz") {
                prev_item = $('div[data-status="book_last"]');
                prev_item_type = "book";
            } else if(item_type == "book") {
                prev_item = $('div[data-status="video_last"]');
                prev_item_type = "video";
            } else if(item_type == "video") {
                return;
            }
            if(prev_item) {
                let last_item_id = prev_item.find('div.part-content-action').attr('data-id');
                @this.setItem({id: last_item_id, type: prev_item_type});
            }
        }
    })
    $('#btn_next_item').on('click', function() {
        var selected_item = $('#selected_item');
        var item_id = selected_item.attr('data-id');
        var item_type = selected_item.attr('data-type');
        var next_item_id = (parseInt(item_id)+1);
        if(item_type == "video") {
            stopMediaPlayer(`video_${item_id}`);
        }
        function checkItem(id, type) {
            let item = $(`#content_lesson #items_${type}_${id}`);
            if(item.length > 0) {
                return item
            } else {
                return false
            }
        }
        var get_item = checkItem(next_item_id, item_type);
        if(get_item) {
            // @this.setItem({id: next_item_id, type: item_type});
            @this.nextItem({id: item_id, type: item_type}, {id: next_item_id, type: item_type});
        } else {
            let next_item_type = "";
            if(item_type == "video") {
                next_item_type = "book";
            } else if(item_type == "book") {
                next_item_type = "quiz";
            } else if(item_type == "quiz") {
                return;
            }
            get_item = checkItem(1, next_item_type);
            if(get_item) {
                // @this.setItem({id: 1, type: next_item_type});
                @this.nextItem({id: item_id, type: item_type}, {id: 1, type: next_item_type});
            }
        }
    })

    $('#btn_finish_lesson').on('click', function() {
        var selected_item = $('#selected_item');
        var item_id = selected_item.attr('data-id');
        var item_type = selected_item.attr('data-type');
        if(item_type == "video") {
            stopMediaPlayer(`video_${item_id}`);
        }
        @this.finishLesson({id: item_id, type: item_type});
    })

    $(document).on('click', '.part-content-action', function() {
        $('.content-lesson div.content-active').removeClass('content-active');
        $(this).parents('div.col-12').addClass('content-active');
        var item_id = $(this).attr('data-id');
        var item_type = $(this).attr('data-type');
        if(item_type == "video") {
            stopMediaPlayer(`video_${item_id}`);
        }
        @this.setItem({id: item_id, type: item_type});
    });

    document.addEventListener('breadcrumb_title:load', function (event) {
        buttonBreadcrumb(event.detail.is_last_item);
        $("#breadcrumb_title_item").text(event.detail.title);
    })
    
    document.addEventListener('videojs:load', function (event) {
        if(event.detail.title) {
            $("#breadcrumb_title_item").text(event.detail.title);
            buttonBreadcrumb(event.detail.is_last_item);
        }
        videojs(document.getElementById(event.detail.id), {}, function(){
            // Player (this) is initialized and ready.
        });
    })

    function buttonBreadcrumb(is_last) {
        if(is_last) {
            $('#btn_finish_lesson').show();
            $('#btn_next_item').hide();
        } else {
            $('#btn_finish_lesson').hide();
            $('#btn_next_item').show();
        }
    }

    document.addEventListener('notification:alert', function (event) {
        Swal.fire( {
            icon: 'warning',
            title: 'Oops...',
            text: event.detail.message,
        });
    })
</script>
@endpush