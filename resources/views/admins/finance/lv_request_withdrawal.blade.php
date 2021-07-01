@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
    .loading-text-title {
        width: 100px;
        height: 24px;
    }
    .loading-text-name {
        width: 250px;
        height: 25.6px;
    }
    .loading-text-number {
        width: 200px;
        height: 24px;
    }
    .shine {
        background: #f6f7f8;
        background-image: linear-gradient(to right, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
        background-repeat: no-repeat;
        background-size: 800px 104px; 
        display: inline-block;
        position: relative; 
        
        -webkit-animation-duration: 1s;
        -webkit-animation-fill-mode: forwards; 
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-name: placeholderShimmer;
        -webkit-animation-timing-function: linear;
    }
    .shine-gray {
        background: #e8e8e8;
        background-image: linear-gradient(to right, #e8e8e8 0%, #cccccc 20%, #e8e8e8 40%, #e8e8e8 100%);
        background-size: 800px 104px; 
        display: inline-block;
        position: relative; 
        
        -webkit-animation-duration: 1s;
        -webkit-animation-fill-mode: forwards; 
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-name: placeholderShimmer;
        -webkit-animation-timing-function: linear;
    }
    
    
    @-webkit-keyframes placeholderShimmer {
        0% {
            background-position: -468px 0;
        }
        
        100% {
            background-position: 468px 0; 
        }
    }
</style>
@endsection

@section('Page-Header', 'Request Withdrawal')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item">Finance</li>
<li class="breadcrumb-item active">Request Withdrawal</li>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="info-box bg-primary">
                    <span class="info-box-icon"><i class="fas fa-wallet"></i></span>
                    
                    <div class="info-box-content">
                        <span class="info-box-text">Remaining Balances</span>
                        <span class="info-box-number">IDR {{number_format($finance_remaining_balance, 0, ',', '.')}}</span>
                        
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-tasks"></i></span>
                    
                    <div class="info-box-content">
                        <span class="info-box-text">Total Request</span>
                        <span class="info-box-number">IDR {{number_format($total_request, 0, ',', '.')}}</span>
                        
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="info-box bg-teal">
                    <span class="info-box-icon"><i class="fas fa-sign-in-alt"></i></span>
                    
                    <div class="info-box-content">
                        <span class="info-box-text">Incomes</span>
                        <span class="info-box-number">IDR {{number_format($finance_income, 0, ',', '.')}}</span>
                        
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="info-box bg-maroon">
                    <span class="info-box-icon"><i class="fas fa-sign-in-alt"></i></span>
                    
                    <div class="info-box-content">
                        <span class="info-box-text">Outcomes</span>
                        <span class="info-box-number">IDR {{number_format($finance_outcome, 0, ',', '.')}}</span>
                        
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Bank Information</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($withdrawals as $withdrawal)
                            <tr>
                                <td class="align-middle" width="40px;">{{($loop->index+1)}}</td>
                                <td> 
                                    <p class="text-sm mb-0">
                                        <b>{{$withdrawal->bank_account->bank_name}}</b>
                                        <br>
                                        {{$withdrawal->bank_account->bank_account_name}} - {{$withdrawal->bank_account->bank_account_number}}    
                                    </p>    
                                </td>
                                <td class="align-middle">IDR {{number_format($withdrawal->amount, 0, ',', '.')}}</td>
                                <td class="align-middle">
                                    @if ($withdrawal->status_number == 1)
                                    <span class="text-sm text-orange"><i class="fas fa-circle-notch fa-spin mr-1"></i> On Process</span>
                                    @else
                                    <span class="text-sm text-lightblue"><i class="fas fa-hourglass-end fa-pulse mr-1"></i> Waiting for Approval</span>   
                                    @endif
                                </td>
                                <td class="text-center py-0 align-middle" width="100px;">
                                    @if ($withdrawal->status_number == 0)
                                    <div class="btn-group btn-group-xs">
                                        <button data-id="{{$withdrawal->id}}" class="btn btn-accept btn-success btn-sm">Accept</button>
                                        <button class="btn btn-danger btn-sm">Reject</button>
                                    </div>
                                    @elseif($withdrawal->status_number == 1)
                                    <div class="btn-group btn-group-xs">
                                        <button data-id="{{$withdrawal->id}}" class="btn btn-primary btn-sm">Finish</button>
                                        <button class="btn btn-secondary btn-sm">Cancel</button>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr class="border bg-light">
                                <td colspan="5" class="text-center text-secondary">No Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal-insert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Withdrawal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="insert">
                    <div class="modal-body">
                        <div class="w-100 mb-3">
                            <label for="name">Bank Account</label>
                            <button type="button" data-target-close="#modal-insert" data-toggle="modal" data-target="#modal-list-bank" class="btn btn-warning btn-xs float-right"><i class="fas fa-edit"></i></button>
                            <div class="w-100">
                                <div wire:loading.class="d-block" class="card bg-light d-none">
                                    <div class="card-header border-bottom-0">
                                        <div class="loading-text-title shine-gray"></div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="lead"><div class="loading-text-name shine-gray"></div></h2>
                                                <div class="loading-text-number shine-gray"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:loading.remove class="card bg-light">
                                    <div class="card-header border-bottom-0">
                                        {{$bank_account['name']}}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="lead"><b>{{$bank_account['account_name']}}</b></h2>
                                                <p class=""><b><i class="fas fa-money-check mr-2"></i>: </b> {{$bank_account['account_number']}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:loading.attr="disabled" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" wire:loading.attr="disabled" id="btn-insert btn-process" class="btn btn-primary">Save</button>
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
        $(document).on('click', '.btn-accept', function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: "Do you want to accept the request?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes, Accept it!',
                showLoaderOnConfirm: true,
                preConfirm: async () => {
                    var data = await @this.acceptRequest(id)
                    return data
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then(async (result) => {
                console.log(result);
                if (result.value.status_code == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: result.value.message,
                    });
                }
                else if (result.value.status_code == 403) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: result.value.message,
                    });
                }
            })
        })
    })
    document.addEventListener('notification:success', function (event) {
        $('.modal').modal('hide');
        
        Swal.fire({
            icon: 'success',
            title: event.detail.title,
            text: event.detail.message,
        });
    })
    document.addEventListener('notification:error', function (event) {
        $('.modal').modal('hide');
        
        Swal.fire({
            icon: 'error',
            title: event.detail.title,
            text: event.detail.message,
        });
    })
</script> 
@endpush
