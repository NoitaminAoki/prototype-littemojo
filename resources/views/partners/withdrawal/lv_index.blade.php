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
                    <button class="btn btn-primary">Add Withdrawal</button>
                    <a href="{{ route('partner.manage.withdrawal.bank_account') }}" class="btn btn-primary">Manage Bank Account</a>
                </div>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Bank Information</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($withdrawals as $withdrawal)
                        <tr>
                            <td width="40px;">{{($loop->index+1)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal-insert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="insert">
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
                        <div class="w-100 mb-3">
                            <div class="custom-control custom-checkbox">
                                <input {{($is_main_bank)? 'disabled' : ''}} wire:model.defer="bank_account.is_main_bank" value="1" class="custom-control-input" type="checkbox" id="customCheckbox1">
                                <label for="customCheckbox1" class="custom-control-label font-weight-normal">Set to main bank</label>
                            </div>
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
</script> 
@endpush
