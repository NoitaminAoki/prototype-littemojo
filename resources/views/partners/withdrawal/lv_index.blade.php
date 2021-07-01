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

@section('Page-Header', 'Withdrawal')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Withdrawal</li>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="col-12 mb-4">
                    @if ($can_add_withdrawal)
                    <button wire:click="resetInput" data-toggle="modal" data-target="#modal-insert" class="btn btn-primary mr-2">Add Withdrawal</button>
                    @else
                    <button id="btn-prevent-add" class="btn btn-primary mr-2">Add Withdrawal</button>
                    @endif
                    <a href="{{ route('partner.manage.withdrawal.bank_account') }}" class="btn btn-primary">Manage Bank Account</a>
                </div>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Bank Information</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-center" width="100px;">Action</th>
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
                            <td class="text-center py-0 align-middle"  width="100px;">
                                @if ($withdrawal->status_number == 0)
                                <div class="btn-group btn-group-sm">
                                    <button wire:click="setWithdrawal({{$withdrawal->id}})" wire:loading.attr="disabled" data-toggle="modal" data-target="#modal-update" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    <button data-id="{{$withdrawal->id}}" wire:loading.attr="disabled" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                </div>
                                @elseif ($withdrawal->status_number == 1)
                                <small class="text-muted">No Action</small>
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
                                <div class="card bg-light">
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
                        <div class="w-100 mb-3">
                            <label for="amount">Amount</label>
                            <input wire:model.defer="amount" type="text" name="amount" class="form-control" autocomplete="off" required>
                            <div class="w-100 mt-2">
                                <span>Max Amount: {{number_format($max_amount, 0, ',', '.')}}</span>
                                <br>
                                <span>Min Amount: {{number_format(10000, 0, ',', '.')}}</span>
                            </div>
                        </div>
                        <div class="w-100">
                            @error('amount')
                            <span class="text-danger">Amount must be a number and minimal Amount is 10.000.</span>
                            @enderror
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
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="w-100 mb-3">
                            <label for="name">Bank Account</label>
                            <button type="button" data-target-close="#modal-update" data-toggle="modal" data-target="#modal-list-bank" class="btn btn-warning btn-xs float-right"><i class="fas fa-edit"></i></button>
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
                        <div class="w-100 mb-3">
                            <label for="amount">Amount</label>
                            <input wire:model.defer="amount" type="text" name="amount" class="form-control" autocomplete="off" required>
                            <div class="w-100 mt-2">
                                <span>Max Amount: {{number_format($max_amount, 0, ',', '.')}}</span>
                                <br>
                                <span>Min Amount: {{number_format(10000, 0, ',', '.')}}</span>
                            </div>
                        </div>
                        <div class="w-100">
                            @error('amount')
                            <span class="text-danger">Amount must be a number and minimal Amount is 10.000.</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:loading.attr="disabled" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal-list-bank">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">List Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Bank Name</th>
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th class="text-center">Main Bank</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bank_accounts as $bank_account)
                            <tr>
                                <td width="40px;">{{($loop->index+1)}}</td>
                                <td class="text-capitalize">{{$bank_account->bank_name}}</td>
                                <td>{{$bank_account->bank_account_name}}</td>
                                <td>{{$bank_account->bank_account_number}}</td>
                                <td class="text-center">
                                    @if ($bank_account->is_main_bank)
                                    <i class="fas fa-check-circle text-success"></i>
                                    @endif
                                </td>
                                <td class="text-center py-0 align-middle">
                                    <button wire:click="setBankAccount({{$bank_account->id}})" wire:loading.attr="disabled" class="btn btn-primary btn-xs">Choose</button>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-light">
                                <td colspan="6" class="text-center text-secondary">No Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:loading.attr="disabled" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
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
    $(document).on('click', '#btn-prevent-add', function() {
        Swal.fire({
            icon: 'error',
            title: "Failed!",
            text: 'Previous withdrawal are still being processed.',
        });
    })
    
    document.addEventListener('livewire:load', function () {
        $(document).on('change', 'input[name="amount"]', function() {
            var value = $(this).val();
            var max_amount = @this.max_amount;
            var regex=/^[0-9]+$/;
            if (!value.match(regex) || value > max_amount)
            {
                $(this).val(max_amount)
            }
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
    document.addEventListener('modal:close', function (event) {
        $(event.detail.target).modal('hide');
    })
    document.addEventListener('notification:error', function (event) {
        $('.modal').modal('hide');
        
        Swal.fire({
            icon: 'error',
            title: event.detail.title,
            text: event.detail.message,
        });
    })
    
    $('#modal-list-bank').on('show.bs.modal', function (event) {
        var id_target = $(event.relatedTarget).attr('data-target-close');
        $('#modal-list-bank').attr('data-target-close', id_target);
        $(id_target).modal('hide');
    })
    $('#modal-list-bank').on('hidden.bs.modal', function (event) {
        var id_target = $('#modal-list-bank').attr('data-target-close');
        $(id_target).modal('show');
    })
</script> 
@endpush
