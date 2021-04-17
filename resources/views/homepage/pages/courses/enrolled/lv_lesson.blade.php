@section('title', "{$course->title} - {$lesson->title}")
@section('css')
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
</style>
@endsection

@section('breadcrumb-navbar')
<div class="d-flex justify-content-between">
    <ol class="breadcrumb mb-0" style="background-color: inherit">
        <li class="breadcrumb-item"><a href="{{ route('home.dashboard.course.lesson', ['title' => $course->slug_title]) }}">{{$course->title}}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('home.dashboard.course.lesson', ['title' => $course->slug_title]) }}">{{$lesson->title}}</a></li>
        <li id="breadcrumb_title_item" class="breadcrumb-item active" aria-current="page">{{$selected_item[$selected_item['type']]->title}}</li>
    </ol>
    <div class="d-flex align-items-center">
        <button id="btn_prev_item" class="btn">Prev</button>
        <button id="btn_next_item" class="btn">Next</button>
    </div>
</div>
@endsection

<div class="row">
    <div class="col-md-3">
        <div class="card rounded-0">
            <div class="card-body">
                <h5 class="">{{$lesson->title}}</h5>
                <div id="content_lesson" class="row content-lesson">
                    @foreach ($lesson->videos as $video)
                    <div id="items_video_{{$video->id}}" data-status="{{($loop->iteration == 1)? 'video_first' : (($loop->last)? 'video_last' : '') }}" class="col-12 content-single content-hover {{($video->id == $selected_item['video']['id'])? 'content-active' : ''}}">
                        <div class="info-box part-content-action custom-info-box pl-0 shadow-none mb-0" data-id="{{$video->id}}" data-type="video">
                            <span class="info-box-icon custom-info-box-icon"><i class="far fa-play-circle"></i></span>
                            
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
                    <div id="items_book_{{$book->id}}" data-status="{{($loop->iteration == 1)? 'book_first' : (($loop->last)? 'book_last' : '') }}" class="col-12 content-single content-hover {{($book->id == $selected_item['book']['id'])? 'content-active' : ''}}">
                        <div class="info-box part-content-action custom-info-box pl-0 shadow-none mb-0" data-id="{{$book->id}}" data-type="book">
                            <span class="custom-info-box-icon-circle-single rounded-circle"><i class="fas fa-book-open"></i></span>
                            
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
                    <div id="items_quiz_{{$quiz->id}}" data-status="{{($loop->iteration == 1)? 'quiz_first' : (($loop->last)? 'quiz_last' : '') }}" class="col-12 content-single content-hover {{($quiz->id == $selected_item['quiz']['id'])? 'content-active' : ''}}">
                        <div class="info-box part-content-action custom-info-box pl-0 shadow-none mb-0" data-id="{{$quiz->id}}" data-type="quiz">
                            <span class="info-box-icon custom-info-box-icon"><i class="far fa-question-circle"></i></span>
                            
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
                    <div wire:loading.flex wire:target="setItem" class="overlay modal-overlay" style="display: none;"><i class="fas fa-3x fa-sync-alt fa-spin"></i></div>
                    @if ($selected_item['type'] == 'video')
                    <video id="video_{{$selected_item['video']->id}}" class="video-js vjs-theme-forest" controls preload="auto" data-setup='{"fluid": true}'>
                        <source src="{{ route('home.asset.lesson.videos', ['uuid'=>$selected_item['video']->uuid]) }}" type="video/mp4" />
                            <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                    <div class="w-100 mt-2">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h5 class="mt-0 mb-0 text-font-family">{{$selected_item['video']->title}}</h5>
                            </div>
                            <div>
                                <button class="btn"><i class="custom-icon-size far fa-thumbs-up"></i></button>
                                <button class="btn"><i class="custom-icon-size far fa-thumbs-down"></i></button>
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
                                <button class="btn"><i class="custom-icon-size far fa-thumbs-up"></i></button>
                                <button class="btn"><i class="custom-icon-size far fa-thumbs-down"></i></button>
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
                                <button class="btn"><i class="custom-icon-size far fa-thumbs-up"></i></button>
                                <button class="btn"><i class="custom-icon-size far fa-thumbs-down"></i></button>
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
                                            <h6 class="text-font-family mb-0">Congratulation! You passed!</h6>
                                            <small class="text-secondary">TO PASS 80% or higher</small>
                                        </div>
                                        <h4 class="text-font-family text-xl text-secondary">{{$user_score->score}}%</h4>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-lime" role="progressbar" aria-valuenow="{{$user_score->score}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$user_score->score}}%">
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
                                                    <h4 class="text-success">PASS</h4>
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
                                    <div class="col-12">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Minimum Score</span>
                                                <span class="info-box-number text-center text-muted mb-0">{{$selected_item['quiz']->totalQuestion()}} <span>
                                                </span></span>
                                            </div>
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
                                                @elseif($progress_works <= 80)
                                                <div class="progress-bar bg-teal" role="progressbar" aria-volumenow="{{$progress_works}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$progress_works}}%">
                                                </div>
                                                @elseif($progress_works <= 100)
                                                <div class="progress-bar bg-lime" role="progressbar" aria-volumenow="{{$progress_works}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$progress_works}}%">
                                                </div>
                                                @endif
                                            </div>
                                            <small>
                                                {{$progress_works}}% Complete
                                            </small>
                                          </div>
                                          <div class="post">
                                            @if ($user_score)
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
                    
                    <div class="w-100" style="display: none">
                        <div class="row">
                            <div class="col-12">
                                <span>{{$selected_item['quiz']->progressWork(Auth::guard('web')->user()->id)}}</span>
                            </div>
                            <div class="col-md-4">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-red" role="progressbar" aria-volumenow="{{number_format(3/3 * 100, 2)}}" aria-volumemin="0" aria-volumemax="100" style="width: {{number_format(3/3 * 100, 2)}}%">
                                    </div>
                                </div>
                                <small>
                                    {{number_format(3/3 * 100, 0)}}% Complete
                                </small>
                            </div>
                            <div class="col-md-4">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-red" role="progressbar" aria-volumenow="20" aria-volumemin="0" aria-volumemax="100" style="width: 20%">
                                    </div>
                                </div>
                                <small>
                                    20% Complete
                                </small>
                            </div>
                            <div class="col-md-4">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-orange" role="progressbar" aria-volumenow="40" aria-volumemin="0" aria-volumemax="100" style="width: 40%">
                                    </div>
                                </div>
                                <small>
                                    40% Complete
                                </small>
                            </div>
                            <div class="col-md-4">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="60" aria-volumemin="0" aria-volumemax="100" style="width: 60%">
                                    </div>
                                </div>
                                <small>
                                    60% Complete
                                </small>
                            </div>
                            <div class="col-md-4">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-teal" role="progressbar" aria-volumenow="80" aria-volumemin="0" aria-volumemax="100" style="width: 80%">
                                    </div>
                                </div>
                                <small>
                                    80% Complete
                                </small>
                            </div>
                            <div class="col-md-4">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-lime" role="progressbar" aria-volumenow="100" aria-volumemin="0" aria-volumemax="100" style="width: 100%">
                                    </div>
                                </div>
                                <small>
                                    100% Complete
                                </small>
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
<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
<script>
    $('#btn_prev_item').on('click', function() {
        var selected_item = $('#selected_item');
        var item_id = selected_item.attr('data-id');
        var item_type = selected_item.attr('data-type');
        var prev_item_id = (parseInt(item_id)-1);
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
            @this.setItem({id: next_item_id, type: item_type});
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
                @this.setItem({id: 1, type: next_item_type});
            }
        }
    })
    $(document).on('click', '.part-content-action', function() {
        $('.content-lesson div.content-active').removeClass('content-active');
        $(this).parents('div.col-12').addClass('content-active');
        var item_id = $(this).attr('data-id');
        var item_type = $(this).attr('data-type');
        @this.setItem({id: item_id, type: item_type});
    });
    document.addEventListener('breadcrumb_title:load', function (event) {
        $("#breadcrumb_title_item").text(event.detail.title);
    })
    document.addEventListener('videojs:load', function (event) {
        $("#breadcrumb_title_item").text(event.detail.title);
        videojs(document.getElementById(event.detail.id), {}, function(){
            // Player (this) is initialized and ready.
        });
    })
</script>
@endpush