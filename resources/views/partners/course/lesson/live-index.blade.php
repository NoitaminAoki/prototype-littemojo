@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

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

@section('Page-Header', 'Lessons')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Course</a></li>
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.show', ['course' => $course->id]) }}">{{$course->title}}</a></li>
<li class="breadcrumb-item active">Lesson</li>
@endsection

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
            <div class="card-header">
                <h3 class="card-title">Lessons | LESSONS YOU WILL GAIN</h3>
                <div class="card-tools">
                    <button type="button" wire:click="resetInput" data-toggle="modal" data-target="#modal-insert" class="btn btn-tool bg-primary">
                        Add Lesson(s)
                    </button>
                </div>
                <br>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        @if ($lessons->isEmpty())
                        <tr class="border bg-light">
                            <td class="text-center text-secondary">No Data</td>
                        </tr>
                        @else
                        @foreach ($lessons as $lesson)
                        <tr>
                            <td>{{$lesson->title}}</td>
                            <td>{{$lesson->description}}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button data-toggle="modal" wire:click="setLesson({{$lesson->id}})" data-target="#modal-update" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    <button data-id="{{$lesson->id}}" class="btn btn-danger btn-delete btn-process"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal-insert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Lesson</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="insert">
                    <div class="modal-body">
                        <div class="w-100">
                            <label for="name">Title</label>
                            <textarea wire:model.defer="lesson.title" name="title" class="form-control" style="min-height: 40px;" required>
                            </textarea>
                        </div>
                        @error('lesson.title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="w-100">
                            <label for="name">Description</label>
                            <textarea wire:model.defer="lesson.description" name="description" class="form-control" style="min-height: 80px;" required>
                            </textarea>
                        </div>
                        @error('lesson.description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-insert btn-process" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Lesson</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="w-100">
                            <label for="name">Title</label>
                            <textarea id="edit_textarea_name" wire:model.defer="lesson.title" name="title" class="form-control" style="min-height: 40px;" required>
                            </textarea>
                        </div>
                        @error('lesson.title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror

                        <div class="w-100">
                            <label for="name">Description</label>
                            <textarea id="edit_textarea_name" wire:model.defer="lesson.description" name="description" class="form-control" style="min-height: 80px;" required>
                            </textarea>
                        </div>
                        @error('lesson.description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-update btn-process" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>


@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
    document.addEventListener('livewire:load', function () {
        $(document).on('click', '.btn-delete', function () {
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
                    @this.delete($(this).data('id'));
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
