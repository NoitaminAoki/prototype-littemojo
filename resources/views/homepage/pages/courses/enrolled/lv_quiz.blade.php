@section('title', "{$course->title} Quiz")

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
    .sticky-top {
        top: 56px;
    }
    .content-lesson {
        margin-left: -20px;
        margin-right: -20px;
    }
    .content-single {
        padding-left: 20px;
        border-bottom: 1px solid #fff;
        border-top: 1px solid #fff;
    }
    .content-active {
        background-color: #dcdcdc;
    }
    .part-content-action {
        cursor: pointer;
    }
    .custom-info-box {
        background: inherit;
        min-height: auto;
    }
    .info-box .custom-info-box-icon {
        width: auto;
        align-items: unset;
        font-size: 1.5rem;
    }
    
    .info-box .custom-info-box-icon-single {
        width: auto;
        font-size: 1.3rem;
    }
    
    .info-box .custom-info-box-text {
        white-space: normal;
    }
    
    .info-box .custom-info-box-content {
        justify-content: start;
    }
    
    .info-box .custom-info-box-text-single {
        font-size: 0.875rem;
    }
    
    .text-font-family {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .text-list {
        font-size: 0.875rem;
        line-height: 1.5rem;
        font-weight: normal;
    }
    
    /* imported */
    .custom-info-box-icon-circle-single {
        -webkit-box-align: center;
        -webkit-box-pack: center;
        width: 22px !important;
        height: 22px !important;
        border: 2.2px solid rgb(225, 225, 225);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        font-size: 0.7rem;
    }
    
    .custom-btn-capsule {
        width: 60px;
        border-radius: 500px !important;
    }
    
    .input-cursor {
        cursor: pointer;
    }
    .custom-bg-gray {
        background-color: rgb(211 211 211);
    }
    .custom-box-square {
        width: 70px;
        height: 70px;
    }
    .custom-box-square h6 {
        margin-left: 0.1rem;
    }
    .box-action {
        cursor: pointer;
    }
    .original-alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    
    .original-alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    
    .custom-border-left {
        border-left: 1px solid #b1b1b1;
    }
    
    .text-icon {
        padding: 0.3rem 1rem 0 0;
        font-size: 1.6rem;
    }
    .text-icon-small {
        padding: 0.1rem .5rem 0 0;
        font-size: 1rem;
    }
    .mb-3rem {
        margin-bottom: 3rem;
    }
    .mb-4rem {
        margin-bottom: 4rem;
    }
</style>
@endsection

<div class="row bg-white">
    @if ($is_quiz_completed)
    <div class="w-100 alert {{($user_score->score >= $quiz->minimum_score)? 'original-alert-success' : 'original-alert-danger'}} rounded-0 px-0">
        <div class="col-md-8 col-sm-12 mx-auto">
            <div class="row">
                <div class="col-sm-10">
                    <div class="d-flex">
                        <span class="d-flex align-items-start text-icon">
                            @if ($user_score->score >= $quiz->minimum_score)
                            <i class="text-success fas fa-check"></i>
                            @else
                            <i class="text-danger fas fa-times"></i>
                            @endif
                        </span>
                        <div>
                            @if ($user_score->score >= $quiz->minimum_score)
                            <h4 class="text-font-family font-weight-bold">Congratulation! You passed!</h4>
                            @else
                            <h4 class="text-font-family font-weight-bold">Sorry, you failed!</h4>
                            @endif
                            <small class=""><b>TO PASS</b> {{$quiz->minimum_score}}% or higher</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 custom-border-left">
                    <small class="text-font-family font-weight-bold">TOTAL SCORE</small>
                    <h4 class="text-font-family text-xl {{($user_score->score >= $quiz->minimum_score)? 'text-success' : 'text-danger'}}">{{$user_score->score}}%</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 mt-4 mx-auto">
        <div class="row">
            <div class="col-12 mb-3rem">
                <h4 class="text-font-family font-weight-bold text-xl">{{$quiz->title}} - Quiz</h4>
            </div>
            @foreach ($question_answers as $question)
            <div class="col-md-10">
                <table class="w-100 mb-4rem">
                    <tbody>
                        <tr>
                            <td class="align-top" style="width: 25px;"><span class="text-font-family font-weight-bold">{{$question->orders}}.</span></td>
                            <td>
                                <div class="w-100">
                                    <span class="text-font-family font-weight-bold">{{$question->title}}</span>
                                </div>
                                <div class="w-100 mt-3">
                                    <ul class="list-unstyled">
                                        @foreach ($question->options as $option)
                                        <li>
                                            <div class="d-flex my-3">
                                                <span class="mr-2">
                                                    @if ($question->user_option_id == $option->id)
                                                    <i class="far fa-dot-circle text-primary"></i>
                                                    @else
                                                    <i class="far fa-circle"></i>
                                                    @endif
                                                </span>
                                                <p class="text-font-family mb-0">{{$option->title}}</p>
                                            </div> 
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if ($question->is_correct)
                                <div class="alert original-alert-success rounded-0 mt-4">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-start text-icon-small text-success">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <h6 class="text-font-family mb-0">Correct</h6>
                                    </div>
                                </div>
                                @else
                                <div class="alert original-alert-danger rounded-0 mt-4">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-start text-icon-small text-danger">
                                            <i class="fas fa-times"></i>
                                        </span>
                                        <h6 class="text-font-family mb-0">Incorrect</h6>
                                    </div>
                                </div>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="col-lg-9 col-md-8 order-md-1 order-2">
        <div class="card rounded-0">
            <div class="card-body">
                <div class="overlay-wrapper">
                    <div wire:loading.flex wire:target="setQuestion, setFinish" class="overlay modal-overlay" style="display: none;"><i class="fas fa-3x fa-sync-alt fa-spin"></i></div>
                    <table>
                        <tbody>
                            <tr>
                                <td class="align-top" style="width: 25px;"><span class="text-font-family font-weight-bold">{{$selected_question->orders}}.</span></td>
                                <td>
                                    @if ($selected_question->image)
                                    <div class="w-100">
                                        <img class="col-md-6 col-sm-8 col-12 border shadow-sm" id="img-question-{{$selected_question->id}}" src="{{ route('home.asset.question.images', ['uuid'=>$selected_question->uuid]) }}" alt="{{$selected_question->title}}">
                                    </div>
                                    @endif
                                    <div class="w-100">
                                        <span class="text-font-family font-weight-bold">{{$selected_question->title}}</span>
                                    </div>
                                    <div class="w-100 mt-3">
                                        <ul class="list-unstyled">
                                            @foreach ($selected_question->options as $option)
                                            <li class="form-group">
                                                @if($option->image)
                                                <div class="custom-control custom-radio">
                                                    <input wire:model.defer="selected_option_value" class="custom-control-input input-cursor" type="radio" value="{{$option->id}}" id="option_radio_{{$option->id}}" name="customRadio">
                                                    <label for="option_radio_{{$option->id}}" class="input-cursor custom-control-label font-weight-normal text-font-family">
                                                        <img class="col-md-6 col-sm-8 col-12 border shadow-sm" src="{{ route('home.asset.question.option.images', ['uuid'=>$option->uuid]) }}" alt="{{$option->title}}">
                                                    </label>
                                                </div>
                                                @else
                                                <div class="custom-control custom-radio">
                                                    <input wire:model.defer="selected_option_value" class="custom-control-input input-cursor" type="radio" value="{{$option->id}}" id="option_radio_{{$option->id}}" name="customRadio">
                                                    <label for="option_radio_{{$option->id}}" class="input-cursor custom-control-label font-weight-normal text-font-family">{{$option->title}}</label>
                                                </div>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between">
                    @if ($selected_question->orders > 1)
                    <button wire:click="setQuestion({{$selected_question->orders-1}})" class="btn btn-secondary btn-sm custom-btn-capsule text-left"><i class="fas fa-chevron-left"></i></button>
                    @else
                    <div></div>
                    @endif
                    @if ($selected_question->orders < $selected_question->lastOrder())
                    <button wire:click="setQuestion({{$selected_question->orders+1}})" class="btn btn-primary btn-sm custom-btn-capsule text-right"><i class="fas fa-chevron-right"></i></button>                        
                    @else
                    <button wire:click="setFinish" class="btn btn-success btn-sm custom-btn-capsule w-auto px-4">Finish</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 order-md-2 order-1">
        <div class="card rounded-0">
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    @for ($i = 1; $i <= $selected_question->lastOrder(); $i++)
                    <div class="border">
                        <div class="custom-box-square m-1 box-action" data-order="{{$i}}">
                            <h6 class="text-sm mb-0">{{$i}}.</h6>
                            @if ($user_answer->where('orders', $i)->first())
                            <h5 class="text-xl text-center mb-0 text-success"><i class="fas fa-check"></i></h5>
                            @endif
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
    $(document).on('click', '.box-action', function() {
        var data_order = $(this).attr('data-order');
        @this.setQuestion(data_order);
    });
    document.addEventListener('notification:alert', function (event) {
        Swal.fire( {
            icon: 'warning',
            title: 'Oops...',
            text: event.detail.message,
        });
    })
    document.addEventListener('notification:dialog_finish', function (event) {
        Swal.fire({
            title: event.detail.message,
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                @this.finishQuiz();
            }
        });
    })
</script>
@endpush