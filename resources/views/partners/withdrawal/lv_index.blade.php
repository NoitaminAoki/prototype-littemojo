@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
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
                    <button wire:click="resetInput" data-toggle="modal" data-target="#modal-insert" class="btn btn-primary">Add Withdrawal</button>
                    <a href="{{ route('partner.manage.withdrawal.bank_account') }}" class="btn btn-primary">Manage Bank Account</a>
                </div>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Bank Information</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($withdrawals as $withdrawal)
                        <tr>
                            <td width="40px;">{{($loop->index+1)}}</td>
                            <td> 
                                <p class="text-sm mb-0">
                                    <b>{{$withdrawal->bank_account->bank_name}}</b>
                                    <br>
                                    {{$withdrawal->bank_account->bank_account_name}} - {{$withdrawal->bank_account->bank_account_number}}    
                                </p>    
                            </td>
                            <td>{{$withdrawal->amount}}</td>
                            <td><span class="text-sm text-{{($withdrawal->status == 'success')? 'sucess' : 'warning'}}">{{$withdrawal->status}}</span></td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button wire:click="setBank({{$withdrawal->id}})" wire:loading.attr="disabled" data-toggle="modal" data-target="#modal-update" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    <button data-id="{{$withdrawal->id}}" wire:loading.attr="disabled" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                </div>
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
                            <button type="button" data-toggle="modal" data-target="#modal-list-bank" class="btn btn-warning btn-xs float-right"><i class="fas fa-edit"></i></button>
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
                            <label for="name">Bank Name</label>
                            <input wire:model.defer="bank_account.name" type="text" name="bank_name" class="form-control">
                        </div>
                        <div class="w-100 mb-3">
                            <label for="bank_account_name">Account Name</label>
                            <input wire:model.defer="bank_account.account_name" type="text" name="bank_account_name" class="form-control">
                        </div>
                        <div class="w-100 mb-3">
                            <label for="bank_account_number">Account Number</label>
                            <input wire:model.defer="bank_account.account_number" type="text" name="bank_account_number" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:loading.attr="disabled" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" wire:loading.attr="disabled" id="btn-insert btn-process" class="btn btn-primary">Update</button>
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
                    <h4 class="modal-title">Update Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="w-100 mb-3">
                            <label for="name">Bank Name</label>
                            <input wire:model.defer="bank_account.name" type="text" name="bank_name" class="form-control">
                        </div>
                        <div class="w-100 mb-3">
                            <label for="bank_account_name">Account Name</label>
                            <input wire:model.defer="bank_account.account_name" type="text" name="bank_account_name" class="form-control">
                        </div>
                        <div class="w-100 mb-3">
                            <label for="bank_account_number">Account Number</label>
                            <input wire:model.defer="bank_account.account_number" type="text" name="bank_account_number" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:loading.attr="disabled" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" wire:loading.attr="disabled" id="btn-insert btn-process" class="btn btn-primary">Update</button>
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
    document.addEventListener('notification:success', function (event) {
        $('.modal').modal('hide');
        Swal.fire({
            icon: 'success',
            title: event.detail.title,
            text: event.detail.message,
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
