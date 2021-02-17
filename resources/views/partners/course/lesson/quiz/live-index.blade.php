@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('Page-Header', 'Quiz')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.lesson.show', ['lesson' => $lesson->id]) }}" class="text-info">Lesson</a></li>
<li class="breadcrumb-item active">Quiz</li>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quizzes @if($isOpenOrder) - Ordering @endif</h3>
                <div class="card-tools">
                    <button type="button" wire:click="openOrder" class="btn btn-tool bg-primary">
                        Manage Ordering
                    </button>
                    <button type="button" wire:click="resetInput" data-toggle="modal" data-target="#modal-insert" class="btn btn-tool bg-primary">
                        Add Quizze(s)
                    </button>
                </div>
            </div>
            
            @if($isOpenOrder)
            @include('partners.course.lesson.quiz.component-order')
            @else
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        @if ($quizzes->isEmpty())
                        <tr class="border bg-light">
                            <td class="text-center text-secondary">No Data</td>
                        </tr>
                        @else
                        @foreach ($quizzes as $quiz)
                        <tr>
                            <td>{{$quiz->title}}</td>
                            <td>{{$quiz->total_question}}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button data-toggle="modal" wire:click="setQuiz({{$quiz->id}})" data-target="#modal-update" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    <button data-id="{{$quiz->id}}" class="btn btn-danger btn-delete btn-process"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @endif
            @if ($isOpenOrder)
            <div class="card-footer clearfix">
                <button id="btn-submit-order" type="button" class="btn btn-info float-right">Save</button>
                <button type="button" wire:click="openOrder(false)" class="btn btn-secondary mr-2 float-right">Close</button>
            </div>
            @endif
        </div>        
    </div>
    
    
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal-insert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Quiz</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="w-100">
                            <label for="">Title</label>
                            <input type="text" wire:model.defer="title" class="form-control" required>
                        </div>
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="w-100">
                            <label for="">Total Question</label>
                            <input type="text" wire:model.defer="total_question" class="form-control" required>
                        </div>
                        @error('total_question')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
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
                    <h4 class="modal-title">Update Quiz</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="w-100">
                            <label for="">Title</label>
                            <input type="text" wire:model.defer="quiz.title" class="form-control" required>
                        </div>
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="w-100">
                            <label for="">Total Question</label>
                            <input type="text" wire:model.defer="quiz.total_question" class="form-control" required>
                        </div>
                        @error('total_question')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
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

@section('script-top')
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection
@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
    // jQuery UI sortable for the todo list
</script>
<script>
    document.addEventListener('livewire:load', function () {
        $(document).on('click', '#btn-submit-order', function() {
            let orders_id = $('input.orders-id').map(function() {
                return $(this).val();
            }).get();
            console.log(orders_id);
            @this.submitOrder(orders_id);
        });
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
            if(@this.isOpenOrder) {
                $('.todo-list').sortable({
                    placeholder         : 'sort-highlight',
                    handle              : '.handle',
                    forcePlaceholderSize: true,
                    zIndex              : 999999
                });
            }
        });
    });
</script> 
@endpush
