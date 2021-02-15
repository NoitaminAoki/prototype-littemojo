@extends('partners.templates.main')

@section('css')
@endsection

@section('Page-Header', 'Detail Lesson')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.index') }}" class="text-info">Lesson</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row">
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
                    @if (true)
                    <div class="col-12 text-center">
                        <h3 class="text-sm text-secondary">No Book.</h3>
                    </div>
                    
                    @else
                    
                    {{-- @foreach ($course->experiences as $exp_item)
                        <div class="col-lg-6">
                            <div class="info-box custom-info-box shadow-none p-0">
                                <span class="custom-info-box-icon custom-icon-top border-0 text-success"><i class="fas fa-check"></i></span>
                                
                                
                                <div class="info-box-content custom-content-top pl-0">
                                    <span class="custom-info-box-text">{{$exp_item->name}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        @endforeach --}}

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
                    <a href="" class="btn btn-tool bg-primary">
                        Manage
                    </a>
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="row">
                    @if (true)
                    <div class="col-12 text-center">
                        <h3 class="text-sm text-secondary">No Video.</h3>
                    </div>
                    
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
                    <a href="" class="btn btn-tool bg-primary">
                        Manage
                    </a>
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="row">
                    @if (true)
                    <div class="col-12 text-center">
                        <h3 class="text-sm text-secondary">No Quiz.</h3>
                    </div>
                    
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