@extends('partners.templates.main')

@section('css')
@endsection

@section('Page-Header', 'Detail Lesson')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.show', ['course' => $lesson->course_id]) }}" class="text-info">Course</a></li>
<li class="breadcrumb-item active">Lesson</li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-secondary">Learning Sequence</h4>
                <div class="card-tools">
                    <a href="{{ route('partner.manage.course.lesson.learning.sequence.index', ['lesson' => $lesson->id]) }}" class="btn btn-tool bg-primary">
                        Manage
                    </a>
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="row">
                    @if (true)
                    <div class="col-12 text-center">
                        <h3 class="text-sm text-secondary">No Sequence.</h3>
                    </div>
                    
                    @else
                    <table class="table">
                        <tbody>
                            @foreach ($lesson->books as $book)
                            <tr>
                                <td>
                                    <div>
                                        <a target="_blank" href="{{ route('lesson.books', ['uuid'=>$book->uuid]) }}" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> {{$book->title}}</a>
                                        
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                            <span>{{$book->size}}</span>
                                        </span>
                                    </div> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mb-2">
        <hr style="border-top: 2px solid rgb(132 132 132);">
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-secondary">Books</h4>
                <div class="card-tools">
                    <a href="{{ route('partner.manage.course.lesson.book.index', ['lesson' => $lesson->id]) }}" class="btn btn-tool bg-primary">
                        Manage
                    </a>
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="row">
                    @if ($lesson->books->isEmpty())
                    <div class="col-12 text-center">
                        <h3 class="text-sm text-secondary">No Book.</h3>
                    </div>
                    
                    @else
                    <table class="table">
                        <tbody>
                            @foreach ($lesson->books as $book)
                            <tr>
                                <td>
                                    <div>
                                        <a target="_blank" href="{{ route('lesson.books', ['uuid'=>$book->uuid]) }}" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> {{$book->title}}</a>
                                        
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                            <span>{{$book->size}}</span>
                                        </span>
                                    </div> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-secondary">Videos</h4>
                <div class="card-tools">
                    <a href="{{ route('partner.manage.course.lesson.video.index', ['lesson' => $lesson->id]) }}" class="btn btn-tool bg-primary">
                        Manage
                    </a>
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="row">
                    @if ($lesson->videos->isEmpty())
                    <div class="col-12 text-center">
                        <h3 class="text-sm text-secondary">No Video.</h3>
                    </div>
                    @else
                    <table class="table">
                        <tbody>
                            @foreach ($lesson->videos as $video)
                            @php
                                $video_duration = floor($video->duration/60);
                            @endphp
                            <tr>
                                <td>
                                    <div>
                                        <a target="_blank" href="{{ route('lesson.videos', ['uuid'=>$video->uuid]) }}" class="btn-link text-secondary"><i class="far fa-fw fa-file-video"></i> {{$video->title}}</a>
                                        
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                            <span>{{($video_duration > 1)? "$video_duration Mins" :  "$video_duration Min"}} - {{$video->size}}</span>
                                        </span>
                                    </div> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-secondary">Quizzes</h4>
                <div class="card-tools">
                    <a href="{{ route('partner.manage.course.lesson.quiz.index', ['lesson' => $lesson->id]) }}" class="btn btn-tool bg-primary">
                        Manage
                    </a>
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="row">
                    @if ($lesson->quizzes->isEmpty())
                    <div class="col-12 text-center">
                        <h3 class="text-sm text-secondary">No Quiz.</h3>
                    </div>
                    @else
                    <table class="table">
                        <tbody>
                            @foreach ($lesson->quizzes as $quiz)
                            <tr>
                                <td>
                                    <div>
                                        <a target="_blank" href="#" class="btn-link text-secondary"><i class="far fa-fw fa-question-circle"></i> {{$quiz->title}}<span class="float-right">{{$quiz->minimum_score}}</span> </a>
                                    </div> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>       
</div>
@endsection
@section('script')
<script>
    $('button').click(function(){
        if ($('input').val() != '') {
            $(this).attr('disabled', true)
            $(this).text('Load..')
        } 
    })
</script>
@endsection