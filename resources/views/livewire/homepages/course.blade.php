
@section('css')
<style>
    .sf-arrows .sf-with-ul:after {
        content: none;
    }
    .sf-arrows .sf-with-ul {
        padding-right: 8px;
    }
    .overlay-bg-color {
        background-color: rgb(27 29 81 / 43%);
    }
    
    .overlay-transform-1 {
        background-color: rgb(36 44 76);
        transform: skewX(-35deg);
        transform-origin: 100% -185%;
    }
    
    .overlay-transform-2 {
        background-color: rgb(34 49 113);
        transform: skewX(-24deg);
        transform-origin: 100% -370%;
    }
    
    .title-content {
        border-radius: 0.7rem;
        /* background-color: #0000006b; */
        padding: 10px 0;
    }
    .card-img-top{
        transition: .5s;
    }
    .card-img-top:hover{
        cursor: pointer;
        box-shadow: 3px 5px 5px #888888;
    }
    #course:hover{
        background-color: #fafafa;
        border-radius: 10px;
    }
    #course-side a:hover{
     text-decoration: underline;
 }


</style>
@endsection

<div>

    <!-- start banner Area -->
    <section class="relative" id="home" style="height: 250px;">	
        <div class="top-banner-image" style="background-image: url({{asset('page_dist/img/campus-wallpaper-course.jpg')}})"></div>
        <div class="overlay overlay-bg-color"></div>
        <div class="overlay overlay-transform-1"></div>
        <div class="overlay overlay-transform-2"></div>
        <div class="container">				
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12" style="padding: 0;">
                    <div class="title-content" style="text-align: left;">
                        <p class="text-white link-nav">
                            <a href="index.html">Browse </a>  
                            <span class="lnr lnr-arrow-right"></span>  
                            <a href="courses.html">Python</a>
                        </p>
                        <h3 class="text-white">
                            Python Course
                        </h3>	
                    </div>
                </div>	
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-12">
                <input type="text" class="form-control" wire:model="searchCourse">
                <h5>Showing {{$courses->count()}} total results for {{$searchCourse}} </h5>
                <p>Filter By:</p>            
            </div>
            <div class="col-md">
                <select wire:model="level_id" class="form-control">
                    @foreach($levels as $level)
                    <option value="{{$level->id}}">{{$level->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md">
                <select wire:model="duration" class="form-control">
                    <option value="week">Week</option>
                    <option value="month">Monthly</option>
                </select>
            </div>
            <div class="col-md">
                <select wire:model="skill_id" class="form-control">
                    @foreach($skills as $skill)
                    <option value="{{$skill->id}}">{{$skill->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md">
                <select wire:model="cat_topic_id" class="form-control">
                    @foreach($cat_topics as $cat_topic)
                    <option value="{{$cat_topic->id}}">{{$cat_topic->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row my-3" style="margin: 15px 0;">
            @if($courses->isEmpty())
            <div style="background-color: #f36969;padding: 15px;border-radius: 15px;">
                <h4>
                    Whoops, Course empty
                </h4>
            </div>            
            @else
            @foreach($courses as $course)
            <div class="col-md-12" id="course">
                <div class="row ml-1 mt-3">
                    <div class="card" style="width: 11rem;height: 12rem">
                        <img class="card-img-top" style="width: 100%;height: 100%;object-fit: cover;" src="https://cdn.hackernoon.com/hn-images/1*jFyawcsqoYctkTuZg6wQ1A.jpeg" alt="Card image cap">
                    </div>
                    <div class="ml-3 my-3" id="course-side">
                        <h4><a href="#" style="color: #000;">
                            {{$course->title}}
                        </a></h4>
                        <p><span class="badge badge-secondary">{{$course->catalogTopic->name}}</span></p>
                        @if ($course->duration == 'week')
                        <span class="info-box-text"> 7 days / 1 week </span> <br>
                        @elseif($course->duration == 'month')
                        <span class="info-box-text"> 30 days / 1 month </span> <br>
                        @endif
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span>4.8 | Total students</span>
                        <div>
                            <span class="badge badge-primary">{{$course->level->name}}</span>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
</div>
</div>

</div>

@push('script')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('services.midtrans.client_key')}}"></script>
<script>
    $(document).ready(function() {
        $('.datetimepicker').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: true,
            minDate: moment().format('DD MMMM YYYY HH:mm'),
            maxDate: moment().add(1, 'years').format('DD MMMM YYYY HH:mm'),
            locale: {
                format: 'DD MMMM YYYY HH:mm'
            }
        })
    })
    document.addEventListener('livewire:load', function() {
        $('#input_datepicker').on('change', function(e) {
            @this.set('start_date', e.target.value); 
        });
    })
    document.addEventListener('notification:alert', function (event) {
        Swal.fire( {
            icon: 'warning',
            title: 'Oops...',
            text: event.detail.message,
        });
    })
    document.addEventListener('midtrans:success_transaction', function () {
        Swal.fire( 'Success!', 'Your transaction is being processed.', 'success' );
        setTimeout(function() {
            $('body, html').animate({
                scrollTop: $("#course_outline").offset().top
            }, 600);
        }, 600)
    })
    document.addEventListener('midtrans:snap_pay', function (event) {
        snap.pay(event.detail.snapToken, {
            // Optional
            onSuccess: function(result){
                /* You may add your own js here, this is just example */
                Livewire.emit('evSnapResult', {type: 'success', result: result});
            },
            // Optional
            onPending: function(result){
                /* You may add your own js here, this is just example */
                livewire.emit('evSnapResult', {type: 'pending', result: result});
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */
                Livewire.emit('evSnapResult', {type: 'error', result: result});
            }
        });
    })
</script>
@endpush

{{-- {
    "status_code": "201",
    "status_message": "Transaksi sedang diproses",
    "transaction_id": "5bbdd3c1-af24-44aa-984b-478f5ac484e6",
    "order_id": "TRX20210406C3S2103054",
    "gross_amount": "300000.00",
    "payment_type": "bank_transfer",
    "transaction_time": "2021-04-06 17:31:20",
    "transaction_status": "pending",
    "va_numbers": [
    {
        "bank": "bca",
        "va_number": "38664764937"
    }
    ],
    "fraud_status": "accept",
    "bca_va_number": "38664764937",
    "pdf_url": "https://app.sandbox.midtrans.com/snap/v1/transactions/0851b7da-de3a-4e4c-879b-fcd54217ccc7/pdf",
    "finish_redirect_url": "http://example.com?order_id=TRX20210406C3S2103054&status_code=201&transaction_status=pending"
} --}}