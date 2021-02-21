<div wire:ignore.self class="modal fade" tabindex="-1" id="modal-detail">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Question</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body tab-pane">
                <div class="overlay-wrapper">
                    <div wire:loading.flex wire:target="setQuestion" class="overlay modal-overlay" style="display: none;"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Loading...</div></div>
                    <table>
                        <tr>
                            <td style="width: 5px;" class="{{(!is_null($question->image))? 'align-top' : ''}}">{{$question->orders}})</td>
                            <td>
                                @if (!is_null($question->image))
                                <div class="col-8 mb-2">
                                    <a target="_blank" href="{{ route('question.images', ['uuid' => $question->uuid]) }}">
                                        <img src="{{ route('question.images', ['uuid' => $question->uuid]) }}" class="product-image rounded" alt="Question Image">
                                    </a>
                                </div>
                                @endif
                                <div class="col-12">
                                    <p class="mb-0"> {{$question->title}} </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="mt-3">
                                    @foreach ($question->options as $option)
                                    <div class="col-12 py-1">
                                        @if ($option->type == 'text')
                                        @if ($question->answerKey->option_id == $option->id)
                                        <p class="text-success">{{$style_options[$option->orders]}}. {{$option->title}} </p>
                                        @else
                                        <p>{{$style_options[$option->orders]}}. {{$option->title}} </p>
                                        @endif
                                        @elseif($option->type == 'image')
                                        <div class="d-flex mb-5">
                                            <span class="{{($question->answerKey->option_id == $option->id)? 'text-success' : ''}}">{{$style_options[$option->orders]}}.</span>
                                            <a target="_blank" href="{{ route('question.option.images', ['uuid' => $option->uuid]) }}">
                                                <img src="{{ route('question.option.images', ['uuid' => $option->uuid]) }}" class="product-image image-option rounded" alt="Option Image">
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </table>
                    @if ($question->answerKey)
                    <div class="mt-2">
                        <p>Answer: {{$style_options[$question->answerKey->option->orders]}} </p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->