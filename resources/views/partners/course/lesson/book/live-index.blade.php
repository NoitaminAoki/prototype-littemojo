@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('Page-Header', 'Book')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Course</a></li>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Books</h3>
                <div class="card-tools">
                    <button type="button" wire:click="resetInput" data-toggle="modal" data-target="#modal-insert" class="btn btn-tool bg-primary">
                        Add Book(s)
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        @if ($books->isEmpty())
                        <tr class="border bg-light">
                            <td class="text-center text-secondary">No Data</td>
                        </tr>
                        @else
                        @foreach ($books as $book)
                        <tr>
                            <td>
                                <div>
                                    <a target="_blank" href="{{ route('lesson.books', ['uuid'=>$book->uuid]) }}" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> {{$book->title}}</a>
                                    
                                    <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>{{$book->size}}</span>
                                    </span>
                                </div> 
                            </td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button data-toggle="modal" wire:click="setBook({{$book->id}})" data-target="#modal-update" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    <button data-id="{{$book->id}}" class="btn btn-danger btn-delete btn-process"><i class="fas fa-trash"></i></button>
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
                    <h4 class="modal-title">Add Book</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="upload" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="modal-body">
                        <div class="w-100">
                            <label for="">Title</label>
                            <input type="text" wire:model.defer="title" class="form-control" required>
                        </div>
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="w-100 mt-2">
                            <label for="">File</label>
                            <input type="file" wire:model="file" class="form-control" id="upload{{$iteration}}" required>
                        </div>
                        @error('file')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div x-show="isUploading">
                            <progress max="100" class="w-100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:loading.target="upload" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" wire:loading.target="upload" id="btn-insert btn-process" class="btn btn-primary">Save</button>
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
                    <h4 class="modal-title">Update Book</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="modal-body">
                        <div class="w-100">
                            <label for="">Title</label>
                            <input type="text" wire:model.defer="book.title" class="form-control" required>
                        </div>
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="w-100 mt-2">
                            <label for="">File</label>
                            <small class="text-secondary">no need to be filled if you don't want to change the file.</small>
                            <input type="file" wire:model="update_file" class="form-control" id="upload_update_{{$iteration}}">
                        </div>
                        @error('update_file')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div x-show="isUploading">
                            <progress max="100" class="w-100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:loading.target="update" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" wire:loading.target="update" id="btn-insert btn-process" class="btn btn-primary">Update</button>
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
            console.log("sent");
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
