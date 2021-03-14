@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
    .ui-draggable {
        cursor: move;
    }
    .connected_main_sortable {
        min-height: 80px;
    }
    .form-control.form-control-border {
        border-top: 0;
        border-left: 0;
        border-right: 0;
        border-radius: 0;
        box-shadow: inherit;
    }
</style>
@endsection

@section('Page-Header', 'Learning Sequence')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.lesson.show', ['lesson' => $lesson->id]) }}" class="text-info">Lesson</a></li>
<li class="breadcrumb-item active">Learning Sequence</li>
@endsection

<div class="row">
    <div class="col-lg-12">
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
                                    <div class="px-1 py-2 border my-1 rounded" data-id="{{$book->id}}" data-type="book">
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
                                    <div class="px-1 py-2 border my-1 rounded" data-id="{{$video->id}}" data-type="video">
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
                                    <div class="px-1 py-2 border my-1 rounded" data-id="{{$quiz->id}}" data-type="quiz">
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
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Learning Sequences</h4>
                                <div class="card-tools">
                                    <button type="button" wire:click="addSequence" class="btn btn-tool bg-primary">
                                        Add Sequence
                                    </button>
                                </div>
                            </div>
                        </div>     
                    </div>    
                    
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($sequences as $sequence)
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        {{-- <div class="px-0 col-10 card-title">
                                            <input type="text" class="p-0 form-control form-control-border" placeholder="title">
                                        </div> --}}
                                        <h4 class="card-title">{{$sequence->title}}</h4>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                                                    <button class="dropdown-item">Change Title</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div data-id="{{$sequence->id}}" class="w-100 connected_sequence_sortable connected_main_sortable">
                                            @foreach ($this->sequence_lists->get($sequence->id) as $key => $item_list)
                                            <div class="px-1 py-2 border my-1 rounded" data-unique-id="{{$item_list['unique_id']}}" data-id="{{$item_list['id']}}" data-title="{{$item_list['title']}}" data-type="{{$item_list['type']}}">
                                                <div class="ui-draggable">
                                                    <span class="text-secondary">
                                                        @if ($item_list['type'] == 'book')
                                                        <i class="far fa-fw fa-file-pdf"></i> 
                                                        @elseif($item_list['type'] == 'video')
                                                        <i class="far fa-fw fa-file-video"></i> 
                                                        @elseif($item_list['type'] == 'quiz')
                                                        <i class="far fa-fw fa-question-circle"></i> 
                                                        @endif
                                                        {{$item_list['title']}}
                                                    </span>
                                                </div>    
                                            </div> 
                                            @endforeach
                                        </div>
                                    </div>
                                </div>     
                            </div>
                            @endforeach       
                        </div>
                    </div>
                    
                    @if ($is_changed)
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool bg-primary">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>     
                    </div> 
                    @endif
                    
                </div>       
            </div>
            <div class="col-lg-4">  
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
    });
    document.addEventListener('livewire:load', function () {
        $("#sortable_book, #sortable_video, #sortable_quiz").sortable({
            connectWith: ".connected_sequence_sortable",
            handle: ".ui-draggable",
            placeholder: "sort-highlight",
            forcePlaceholderSize: true,
            zIndex              : 999999,
            update: function( event, ui ) {
                console.info({ single_sort : { position : ui.position, sender : ui.sender, helper : ui.helper } });
            },
        });
        $(".connected_sequence_sortable").sortable({
            connectWith: ".connected_main_sortable",
            handle: ".ui-draggable",
            placeholder: "sort-highlight",
            forcePlaceholderSize: true,
            zIndex              : 999999,
            update: function( event, ui ) {
                let item = ui.item;
                let parent_id = $(this).attr('data-id');
                // console.log(item.index());
                if(ui.sender){
                    if(ui.sender.hasClass('connected_sequence_sortable')) {
                        @this.switchList({unique_id: item.attr('data-unique-id'), sender_id: ui.sender.attr('data-id'), parent_id, index: item.index(), id: item.attr('data-id'), title: item.attr('data-title'), type: item.attr('data-type')});
                    } else {
                        @this.addItemToList({parent_id, index: item.index(), id: item.attr('data-id'), type: item.attr('data-type')});
                    }
                }
                // console.log($(this).attr('data-id'));
                // console.log(item.attr('data-id'));
                console.info({ list_sort : { position : ui.position, sender : ui.sender, helper : ui.helper } });
            },
        });
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
                }, 600);
            }
        });
    });
</script> 
@endpush
