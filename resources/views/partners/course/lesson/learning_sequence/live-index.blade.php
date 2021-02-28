@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
    .ui-draggable {
        cursor: move;
    }
    .connected_main_sortable {
        min-height: 80px;
    }
</style>
@endsection

@section('Page-Header', 'Learning Sequence')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.lesson.show', ['lesson' => $lesson->id]) }}" class="text-info">Lesson</a></li>
<li class="breadcrumb-item active">Learning Sequence</li>
@endsection

<div class="row">
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Draggable Books</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sortable_book" class="w-100 connected_main_sortable">
                            @if ($books->isEmpty())
                            <p class="text-center text-secondary">No Data</p>
                            @else
                            @foreach ($books as $book)
                            <div class="px-1 py-2 border my-1 rounded">
                                <div class="ui-draggable">
                                    <span class="text-secondary"><i class="far fa-fw fa-file-pdf"></i> {{$book->title}}</span>
                                    
                                    {{-- <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>{{$book->size}}</span>
                                    </span> --}}
                                </div>    
                            </div> 
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Draggable Videos</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sortable_video" class="w-100 connected_main_sortable">
                            @if ($videos->isEmpty())
                            <p class="text-center text-secondary">No Data</p>
                            @else
                            @foreach ($videos as $video)
                            <div class="px-1 py-2 border my-1 rounded">
                                <div class="ui-draggable">
                                    <span class="text-secondary"><i class="far fa-fw fa-file-video"></i> {{$video->title}}</span>
                                    
                                    {{-- <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>{{$video->size}}</span>
                                    </span> --}}
                                </div>    
                            </div> 
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Draggable Quizzes</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sortable_quiz" class="w-100 connected_main_sortable">
                            @if ($quizzes->isEmpty())
                            <p class="text-center text-secondary">No Data</p>
                            @else
                            @foreach ($quizzes as $quiz)
                            <div class="px-1 py-2 border my-1 rounded">
                                <div class="ui-draggable">
                                    <span class="text-secondary"><i class="far fa-fw fa-question-circle"></i> {{$quiz->title}}</span>
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
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Learning Sequences</h4>
                    </div>
                </div>     
            </div>    
            
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Attempt 1</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="w-100 connected_sequence_sortable connected_main_sortable"></div>
                            </div>
                        </div>     
                    </div>      
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Attempt 2</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="w-100 connected_sequence_sortable connected_main_sortable"></div>
                            </div>
                        </div>     
                    </div>      
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Attempt 3</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="w-100 connected_sequence_sortable connected_main_sortable"></div>
                            </div>
                        </div>     
                    </div>      
                </div>
            </div>
            
            <div class="col-lg-6">  
                <div class="card sticky-top">
                    <div class="card-header">
                        <h4 class="card-title">Temporary Storage</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="w-100 connected_sequence_sortable connected_main_sortable"></div>
                    </div>
                </div>      
            </div>
        </div>       
    </div>
</div>


@section('script-top')
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection
@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
    $(document).ready(function() {
        $("#sortable_book, #sortable_video, #sortable_quiz").sortable({
            connectWith: ".connected_sequence_sortable",
            handle: ".ui-draggable",
            placeholder: "sort-highlight",
            forcePlaceholderSize: true,
            zIndex              : 999999
        });
        $(".connected_sequence_sortable").sortable({
            connectWith: ".connected_main_sortable",
            handle: ".ui-draggable",
            placeholder: "sort-highlight",
            forcePlaceholderSize: true,
            zIndex              : 999999
        });
    });
    document.addEventListener('livewire:load', function () {
        $(document).on('click', '.btn-delete', function () {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    @this.delete(id);
                }
            }); 
        });
        Livewire.hook('message.sent', (message, component) => {
            $(".btn-process").attr("disabled", true);
            $(".form-control").attr("readonly", true);
        });
        Livewire.hook('message.processed', (message, component) => {
            $(".btn-process").removeAttr("disabled");
            $(".form-control").removeAttr("readonly");
            if(@this.notification.isOpen) {
                $('.modal').modal('hide');
                setTimeout(() => {
                    Swal.fire( 'Success!', @this.notification.message, 'success' );
                    @this.resetNotif();
                }, 300);
            }
        });
    });
</script> 
@endpush
