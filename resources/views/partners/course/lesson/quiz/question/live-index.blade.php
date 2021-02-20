@section('css-top')
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
    .file-form-control {
        height: calc(2.25rem + 7px);
    }
    .modal-overlay {
        margin-left: 0px !important;
        width: 100% !important;
    }
    .info-box {
        box-shadow: none !important;
        border-radius: 0 !important;
        background: transparent !important;
    }
</style>
@endsection

@section('Page-Header', 'Question')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.lesson.quiz.index', ['lesson' => $quiz->lesson_id]) }}" class="text-info">Quiz</a></li>
<li class="breadcrumb-item active">Question</li>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Questions @if($isOpenOrder) - Ordering @endif</h3>
                <div class="card-tools">
                    <button type="button" wire:click="openOrder" class="btn btn-tool bg-primary">
                        Manage Ordering
                    </button>
                    <button type="button" wire:click="resetInput" data-toggle="modal" data-target="#modal-insert" class="btn btn-tool bg-primary">
                        Add Question(s)
                    </button>
                </div>
            </div>
            
            @if($isOpenOrder)
            @include('partners.course.lesson.quiz.question.component-order')
            @else
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        @forelse ($questions as $quest)
                        <tr>
                            <td style="width: 10px;">{{$loop->index+1}})</td>
                            <td>
                                @if (is_null($quest->title))
                                [image only]
                                @else
                                {{$quest->title}}
                                @endif
                            </td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-primary" wire:click="setQuestion({{$quest->id}})" data-toggle="modal" data-target="#modal-detail"><i class="fas fa-search"></i></button>
                                    <button data-toggle="modal" wire:click="setQuiz({{$quest->id}})" data-target="#modal-update" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    <button data-id="{{$quiz->id}}" class="btn btn-danger btn-delete btn-process"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="border bg-light">
                            <td class="text-center text-secondary">No Data</td>
                        </tr>
                        @endforelse
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body tab-pane">
                        <div class="overlay-wrapper">
                            <div wire:loading.flex wire:target="store" class="overlay modal-overlay" style="display: none;"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Loading...</div></div>
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <label for="title">Question</label>
                                    <div>
                                        <small>Photo</small>
                                        <input type="file" wire:model="image" class="form-control file-form-control" id="question_{{$iteration}}">
                                    </div>
                                    <div class="mt-1">
                                        <small>Text</small>
                                        <textarea wire:model.defer="title" name="title" class="form-control" rows="3"></textarea>
                                    </div>
                                    @if ($errors->has('title'))
                                    <span class="text-danger">You need to fill at least title or image</span>
                                    @elseif($errors->has('image'))
                                    <span class="text-danger">{{$errors->first('image')}}</span>
                                    @endif
                                </div>
                                <div class="col-md-8 border-left">
                                    <div class="w-100">
                                        <div class="float-right">
                                            <button type="button" wire:click="addAnswer" class="btn btn-sm bg-primary">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <p class="lead mb-2">Options:</p>
                                        @error('answers.*.title')
                                        <span class="text-danger">Please fill up the option.</span>
                                        @enderror
                                        <br>
                                        @error('answers.*.image')
                                        <span class="text-danger">Please select a file for the option.</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        @foreach ($answers as $answer)
                                        <div class="col-lg-12 my-2">
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                </div>
                                                <div class="col-md-10">
                                                    <label for="title">Option {{$loop->index+1}} <small class="text-danger">*</small></label>
                                                    @if ($answer['type'] == "text")
                                                    <textarea wire:model.defer="answers.{{$loop->index}}.title" name="title" class="form-control" rows="3" required></textarea>
                                                    @else
                                                    <small>Max file: 5MB</small>
                                                    <input type="file" wire:model="answers.{{$loop->index}}.image" accept="image/jpeg,image/jpg,image/gif,image/png" class="form-control file-form-control" id="answers_{{$loop->index}}_{{$iteration}}" required>
                                                    @endif
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <div class="text-left">
                                                        <label>Type: </label>
                                                        <div class="btn-group btn-group-sm w-100">
                                                            <button type="button" wire:click="setType({{$loop->index}}, 'text')" class="btn btn-sm {{($answer['type'] == 'text')? 'btn-success' : 'btn-light'}}"><i class="fas fa-keyboard"></i></button>
                                                            <button type="button" wire:click="setType({{$loop->index}}, 'image')" class="btn btn-sm {{($answer['type'] == 'image')? 'btn-success' : 'btn-light'}}"><i class="fas fa-image"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <button type="button" wire:click="deleteAnswer({{$loop->index}})" class="btn btn-sm btn-process btn-danger"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4 border-left">
                                    <p class="lead mb-2">Answer Key:</p>
                                    @error('answer_key')
                                    <span class="text-danger">You need to choose the answer's key</span>
                                    @enderror
                                    <div class="d-flex flex-wrap mt-3">
                                        @foreach ($answers as $answer)
                                        <div class="my-1 mx-2 text-center">
                                            <label class="w-100" for="r_answer_{{$loop->index}}">Option {{$loop->index+1}}</label>
                                            <div class="icheck-success d-inline mb-2">
                                                <input type="radio" wire:model.defer="answer_key" value="{{$loop->index}}" name="r_answer" id="r_answer_{{$loop->index}}">
                                                <label for="r_answer_{{$loop->index}}">
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
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
    
    @include('partners.course.lesson.quiz.question.component-modal-detail')

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal-update">
        <div class="modal-dialog modal-xl">
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
        });
        Livewire.hook('message.processed', (message, component) => {
            $(".btn-process").removeAttr("disabled");
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
