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

@section('Page-Header', 'Experiences')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Course</a></li>
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.show', ['course' => $course->id]) }}">{{$course->title}}</a></li>
<li class="breadcrumb-item active">Experience</li>
@endsection

<div class="row">
    <div class="col-12">
        <div wire:ignore.self id="message-success" class="alert alert-success alert-dismissible" style="display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Message!</h5>
            successfully adding data.
        </div>
        <div wire:ignore.self id="message-success-updated" class="alert alert-success alert-dismissible" style="display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Message!</h5>
            successfully updating data.
        </div>
        <div wire:ignore.self id="message-success-deleted" class="alert alert-success alert-dismissible" style="display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Message!</h5>
            successfully deleting data.
        </div>
    </div>
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
                <h3 class="card-title">Experiences | WHAT YOU WILL LEARN</h3>
                <div class="card-tools">
                    <button type="button" data-toggle="modal" data-target="#modal-insert" class="btn btn-tool bg-primary">
                        Add Experience(s)
                    </button>
                </div>
                <br>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        @if ($experiences->isEmpty())
                        <tr class="border bg-light">
                            <td class="text-center text-secondary">No Data</td>
                        </tr>
                        @else
                        @foreach ($experiences as $exp)
                        <tr>
                            <td>{{$exp->name}}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button data-toggle="modal" wire:click="$emit('liveSetExperience', {{$exp}})" data-target="#modal-update" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    <button onclick="confirm('Confirm delete?') || event.stopImmediatePropagation()" wire:click="delete({{$exp->id}})" wire:loading.attr="disabled" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
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
                    <h4 class="modal-title">Add Experience</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="$emit('liveInsert')">
                    <div class="modal-body">
                        <label for="name">Name</label>
                        <textarea wire:model.defer="name" name="name" class="form-control" style="min-height: 80px;" required>
                        </textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-insert" class="btn btn-primary">Save</button>
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
                    <h4 class="modal-title">Update Experience</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="$emit('liveUpdate')">
                    <div class="modal-body">
                        <label for="name">Name</label>
                        <textarea id="edit_textarea_name" wire:model.defer="selected_exp.name" name="name" class="form-control" style="min-height: 80px;" required>
                        </textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-update" class="btn btn-primary">Update</button>
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
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('liveInsert', () => {
            $('#btn-insert').attr("disabled", true);
        });
        Livewire.on('liveSetExperience', () => {
            $('#edit_textarea_name').val('');
            $('#btn-update').attr("disabled", true);
        });
        Livewire.on('liveUpdate', () => {
            $('#btn-update').attr("disabled", true);
        });
        Livewire.hook('message.processed', (message, component) => {
            if(@this.isInserted) {
                @this.isInserted = false;
                $('#btn-insert').removeAttr("disabled");
                $('#modal-insert').modal('hide');    
                $('#message-success').slideDown();
                setTimeout(() => {
                    $('#message-success').slideUp();
                }, 3000)
            }
            else if(@this.isUpdated) {
                @this.isUpdated = false;
                $('#btn-update').removeAttr("disabled");
                $('#modal-update').modal('hide');    
                $('#message-success-updated').slideDown();
                setTimeout(() => {
                    $('#message-success-updated').slideUp();
                }, 3000)
            }
            else if(@this.isDeleted) {
                @this.isDeleted = false;  
                $('#message-success-deleted').slideDown();
                setTimeout(() => {
                    $('#message-success-deleted').slideUp();
                }, 3000)
            }
        });
    });
</script>    
@endpush
