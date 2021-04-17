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
</style>
@endsection

<div class="row">
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
                                    <div class="w-100">
                                        <span class="text-font-family font-weight-bold">{{$selected_question->title}}</span>
                                    </div>
                                    <div class="w-100 mt-3">
                                        <ul class="list-unstyled">
                                            @foreach ($selected_question->options as $option)
                                            <li class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input wire:model="selected_option_value" class="custom-control-input input-cursor" type="radio" value="{{$option->id}}" id="option_radio_{{$option->id}}" name="customRadio">
                                                    <label for="option_radio_{{$option->id}}" class="input-cursor custom-control-label font-weight-normal text-font-family">{{$option->title}}</label>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        {{-- <p class="text-font-family my-3">{{$option->title}}</p> --}}
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