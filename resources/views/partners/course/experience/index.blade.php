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
<li class="breadcrumb-item"><a href="#">{{$course->title}}</a></li>
<li class="breadcrumb-item active">Experience</li>
@endsection

<div class="row">
    <div class="col-12">
        <div id="message-success" class="alert alert-success alert-dismissible" style="display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Message!</h5>
            successfully added data.
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
                    <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-tool bg-primary">
                        Add Experience(s)
                    </button>
                </div>
                <br>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        @foreach ($experiences as $exp)
                        <tr>
                            <td>{{$exp->name}}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal-default">
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
                        <input wire:model="name" class="form-control" type="text" required>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
            console.log(@this.isInserted); 
        });
        Livewire.hook('message.processed', (message, component) => {
            if(@this.isInserted) {
                $('#modal-default').modal('hide');    
                $('#message-success').slideDown();
                setTimeout(() => {
                    $('#message-success').slideUp();
                }, 3000)
            }
        });
    });
</script>    
@endpush
