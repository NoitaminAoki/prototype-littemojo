@extends('partners.templates.main')

@section('css')
<style>
    .custom-bg-gradient-green {
        color: white;
        background-image: linear-gradient(to right, rgb(9, 227, 56, 1), rgba(9, 209, 227,1));
    }
    
    .custom-bg-gradient-orange {
        color: white;
        background-image: linear-gradient(to right, rgba(227, 114, 9,1), rgba(227, 173, 9,1));
    }
    .custom-info-box {
        min-height: 60px !important;
    }
    .custom-info-box-content {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-pack: center;
        justify-content: center;
        line-height: 120%;
    }
    .custom-content-top {
        justify-content: end !important;
    }
    .custom-info-box-icon {
        -webkit-box-align: center;
        -webkit-box-pack: center;
        width: 44px !important;
        height: 44px !important;
        border: 2px solid rgb(225, 225, 225);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
    }
    .custom-info-box-text {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: pre-wrap;
    }
    .custom-icon-top {
        align-items: end;
        padding-top: 3px;
    }
    a.custom-text-white:hover {
        text-decoration: underline !important;
    }
    .custom-header-text-lesson {
        font-size: 3.75rem;
        line-height: 4.5rem;
        font-weight: normal;
        font-family: OpenSans-Light, OpenSans, Arial, sans-serif;
    }
    .custom-headline-text-lesson {
        font-family: OpenSans,Arial,sans-serif;
        font-size: 20px;
        line-height: 24px;
    }
    .custom-icon-sm {
        width: 40px !important;
        height: 40px !important;
    }
</style>
@endsection

@section('Page-Header', 'Detail Course')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.index') }}" class="text-info">Course</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card custom-bg-gradient-green">
            <div class="card-body">
                <ol class="breadcrumb pl-0" style="background-color: transparent">
                    <li class="mx-1"><a href="{{ route('partner.manage.course.index') }}" class="text-white custom-text-white text-decoration-none">Course</a></li>
                    <li class="mx-1"><i class="fas fa-chevron-right text-sm "></i></li>
                    <li class="mx-1"><a href="{{ route('partner.manage.course.index') }}" class="text-white custom-text-white text-decoration-none">{{$course->nama_catalog}}</a></li>
                    <li class="mx-1"><i class="fas fa-chevron-right text-sm"></i></li>
                    <li class="mx-1"><a href="{{ route('partner.manage.course.index') }}" class="text-white custom-text-white text-decoration-none">{{$course->nama_catalog_topic}}</a></li>
                </ol>
                <h2 class="font-weight-bold"> {{$course->title}} </h2>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <h4>About this Course</h4>
                        <div class="pr-1">
                            {!! $course->description !!}
                        </div>
                    </div>
                    <div class="col-lg-4 border-left">
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="far fa-clock"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">Duration</h5></span>
                                @if ($course->duration == 'week')
                                <span class="info-box-text"> 7 days / 1 week </span>
                                @elseif($course->duration == 'month')
                                <span class="info-box-text"> 30 days / 1 month </span>
                                @endif
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="fas fa-calendar-check"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">flexible schedules</h5></span>
                                <span class="info-box-text"> free to choose a start date </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="fas fa-signal"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0"> {{$course->nama_level}} </h5></span>
                                <span class="info-box-text">{{$course->desc_level}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="fas fa-tag"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">Price</h5></span>
                                <span class="info-box-text">Rp {{number_format($course->price, 0)}} </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Summary</h4>
            </div>
            <div class="card-body">
                <div class="card-body px-2 pt-0 border">
                    <div class="card-header">
                        <h3 class="card-title text-secondary">WHAT YOU WILL LEARN</h3>
                        <div class="card-tools">
                            <a href="{{ route('partner.manage.course.experience.index', ['course_id' => $course->id]) }}" class="btn btn-tool bg-primary">
                                Manage
                            </a>
                        </div>
                        <br>
                    </div>
                    <div class="row mt-4">
                        @if ($course->experiences->isEmpty())
                        <div class="col-12 text-center">
                            <h3 class="text-sm text-secondary">No Experience.</h3>
                        </div>
                        @else
                        
                        @foreach ($course->experiences as $exp_item)
                        <div class="col-lg-6">
                            <div class="info-box custom-info-box shadow-none p-0">
                                <span class="custom-info-box-icon custom-icon-top border-0 text-success"><i class="fas fa-check"></i></span>
                                
                                
                                <div class="info-box-content custom-content-top pl-0">
                                    <span class="custom-info-box-text">{{$exp_item->name}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        @endforeach
                        
                        @endif
                    </div>
                </div>
                <div class="card-body px-2 pt-0 mt-3 border">
                    <div class="card-header">
                        <h3 class="card-title text-secondary">SKILLS YOU WILL GAIN</h3>
                        <div class="card-tools">
                            <a href="{{ route('partner.manage.course.skill.index', ['course_id' => $course->id]) }}" class="btn btn-tool bg-primary">
                                Manage
                            </a>
                        </div>
                        <br>
                    </div>
                    @if ($course->skills->isEmpty())
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <h3 class="text-sm text-secondary">No Skill.</h3>
                        </div>
                    </div>
                    @else
                    
                    <div class="d-flex flex-wrap mt-3">
                        @foreach ($course->skills as $skill_item)
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">{{$skill_item->name}}</div>
                        @endforeach
                    </div>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{ route('partner.manage.course.lesson.index', ['course_id' => $course->id]) }}" class="btn btn-tool bg-primary">
                        Manage
                    </a>
                </div>
                <h4 class="text-center">Syllabus - What you will learn from this course</h4>
            </div>
            <div class="card-body">
                <div class="my-1">
                    <br>
                </div>
                <div class="row">
                    @if ($course->lessons->isEmpty())
                    <div class="col-12 text-center">
                        <h3 class="text-sm text-secondary">No Lesson.</h3>
                    </div>
                    @else
                    @foreach($course->lessons as $key => $lesson)
                    <div class="col-12 mt-3 row">
                        <div class="col-lg-2">
                            <div class="text-center" style="display: inline-block">
                                <span>LESSON</span>
                                <br>
                                <span class="custom-header-text-lesson">{{$key+1}}</span>
                            </div>
                        </div>
                        <div class="col-lg-10 border-bottom">
                            <h2 class="font-weight-bold custom-headline-text-lesson mb-3">{{$lesson->title}}</h2>
                            
                            <p>{{$lesson->description}}</p>
                            
                            <div class="info-box custom-info-box shadow-none p-0 mb-5">
                                <div class="custom-info-box-content pr-1">
                                    <span class="custom-info-box-icon border-0 custom-icon-sm custom-bg-gradient-green rounded-circle text-white"><i class="fas fa-book"></i></span>
                                </div>
                                
                                <div class="info-box-content">
                                    <span class="info-box-text text-secondary">23 videos (Total 74 min), 6 readings, 10 quizzes</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    @endforeach
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