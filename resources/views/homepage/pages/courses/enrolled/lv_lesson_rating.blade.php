@section('title', "{$course->title} - {$lesson->title}")
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
    /* Star Rating */
    .number-rating {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-size: 4rem;
        font-weight: 600;
    }
    
    .text-review {
        font-size: .9rem;
    }
    
    .rating-review {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-size: 2.75rem;
        font-weight: 600;
    }
    
    .rating-review-sm {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-size: 1rem;
    }
    
    .text-rating {
        font-family: 'Open Sans', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-size: 1.5rem;
    }
    
    .rating-fieldset, .rating-label { margin: 0; padding: 0; }
    
    /****** Style Star Rating Widget *****/
    
    .rating-label {
        cursor: pointer;
    }
    
    .rating { 
        border: none;
        float: left;
    }
    
    .rating > input { display: none; } 
    .rating > .rating-label:before { 
        margin: 5px;
        font-size: 2.25em;
        font-family: "Font Awesome 5 Free";
        display: inline-block;
        content: "\f005";
    }
    
    .rating > .rating-label { 
        color: #ddd; 
        float: right; 
    }
    
    /***** CSS Magic to Highlight Stars on Hover *****/
    
    .rating > input:checked ~ .rating-label, /* show gold star when clicked */
    .rating:not(:checked) > .rating-label:hover, /* hover current star */
    .rating:not(:checked) > .rating-label:hover ~ .rating-label { color: #FFD700;  } /* hover previous stars in list */
    
    .rating > input:checked + .rating-label:hover, /* hover current star when changing rating */
    .rating > input:checked ~ .rating-label:hover,
    .rating > .rating-label:hover ~ input:checked ~ .rating-label, /* lighten current selection */
    .rating > input:checked ~ .rating-label:hover ~ .rating-label { color: #FFED85;  }
    /* End Star Rating */
</style>
@endsection

@section('breadcrumb-navbar')
<div class="d-flex justify-content-between">
    <ol class="breadcrumb mb-0" style="background-color: inherit">
        <li class="breadcrumb-item"><a href="{{ route('home.dashboard.course', ['title' => $course->slug_title]) }}">{{$course->title}}</a></li>
        <li class="breadcrumb-item active">{{$lesson->title}}</li>
    </ol>
    <div class="d-flex align-items-center">
    </div>
</div>
@endsection

<div class="row">
    <div class="col-md-6 col-sm-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5> Give Your Feedback Here</h5>
            </div>
            <div class="card-body">
                <div class="overlay-wrapper">
                    <div wire:loading.flex wire:target="submitRating" class="overlay modal-overlay" style="display: none;"><i class="fas fa-3x fa-sync-alt fa-spin"></i></div>
                    <div class="d-flex justify-content-center">
                        <h5 id="number_rating" class="number-rating">{{$rating_value}}</h5>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h5 id="text_rating" class="text-rating">
                            @if ($rating_value == 5)
                                Awesome
                            @elseif($rating_value == 4)
                                Pretty Good
                            @elseif($rating_value == 3)
                                Good
                            @elseif($rating_value == 2)
                                Kinda Bad
                            @elseif($rating_value == 1)
                                Bad
                            @endif
                        </h5>
                    </div>
                    <div class="d-flex justify-content-center">
                        <fieldset class="rating-fieldset rating">
                            <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star5" name="rating" value="5" data-title="Awesome" /><label class="rating-label full" for="star5" title="Awesome - 5 Stars"></label>
                            <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star4" name="rating" value="4" data-title="Pretty good" /><label class="rating-label full" for="star4" title="Pretty good - 4 Stars"></label>
                            <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star3" name="rating" value="3" data-title="Good" /><label class="rating-label full" for="star3" title="Good - 3 Stars"></label>
                            <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star2" name="rating" value="2" data-title="Kinda bad" /><label class="rating-label full" for="star2" title="Kinda bad - 2 Stars"></label>
                            <input type="radio" class="input-rating" wire:model.defer="rating_value" id="star1" name="rating" value="1" data-title="Bad" /><label class="rating-label full" for="star1" title="Bad - 1 Star"></label>
                        </fieldset>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea wire:model.defer="rating_desc" name="rating_description" id="description" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button class="btn btn-primary" wire:click="submitRating">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 my-4"></div>
</div>

@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
    $("input.input-rating").on('click', function() {
        $('#number_rating').text($(this).val());
        $('#text_rating').text($(this).attr('data-title'));
    })
    $("#btn_get").click(function() {
        var radios = document.getElementsByName('rating');
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                // do whatever you want with the checked radio
                console.log(radios[i].value);
                
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
    })
    $(document).on('click', '#btn_requiz', function() {
        var score_id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure want to re-quiz?",
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
                @this.resetQuiz(score_id);
            }
        });
    })
    document.addEventListener('notification:alert', function (event) {
        Swal.fire( {
            icon: 'warning',
            title: 'Oops...',
            text: event.detail.message,
        });
    })
    document.addEventListener('notification:success', function (event) {
        Swal.fire( {
            icon: 'success',
            title: event.detail.title,
            text: event.detail.message,
            onClose: redirectToLesson,
        });
    })

    function redirectToLesson() {
        Livewire.emit('redirectToCourse');
    }
</script>
@endpush