@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('Page-Header', 'Bank Account')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('partner.manage.withdrawal') }}">Withdrawal</a></li>
<li class="breadcrumb-item active">Bank Account</li>
@endsection

<div class="row">
    <div class="col-12 mb-4">
        <a href="{{ route('partner.manage.withdrawal') }}" class="btn btn-warning btn-sm text-gray-dark" style="width: 80px">Back</a>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Account</h3>
                <div class="card-tools">
                    <button type="button" wire:click="resetInput" data-toggle="modal" data-target="#modal-insert" class="btn btn-tool bg-primary">
                        Add Account(s)
                    </button>
                </div>
                <br>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Bank Name</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th class="text-center">Main Bank</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($bank_accounts->isEmpty())
                        <tr class="border bg-light">
                            <td colspan="6" class="text-center text-secondary">No Data</td>
                        </tr>
                        @else
                        @foreach ($bank_accounts as $bank_account)
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
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button wire:click="setBank({{$bank_account->id}})" wire:loading.attr="disabled" data-toggle="modal" data-target="#modal-update" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    <button data-id="{{$bank_account->id}}" wire:loading.attr="disabled" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
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
                            <input wire:model.defer="bank_account.name" type="text" name="bank_name" class="form-control" required>
                        </div>
                        <div class="w-100 mb-3">
                            <label for="bank_account_name">Account Name</label>
                            <input wire:model.defer="bank_account.account_name" type="text" name="bank_account_name" class="form-control" required>
                        </div>
                        <div class="w-100 mb-3">
                            <label for="bank_account_number">Account Number</label>
                            <input wire:model.defer="bank_account.account_number" type="text" name="bank_account_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:loading.attr="disabled" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" wire:loading.attr="disabled" id="btn-insert" class="btn btn-primary">Save</button>
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
                            <input wire:model.defer="bank_account.name" type="text" name="bank_name" class="form-control" required>
                        </div>
                        <div class="w-100 mb-3">
                            <label for="bank_account_name">Account Name</label>
                            <input wire:model.defer="bank_account.account_name" type="text" name="bank_account_name" class="form-control" required>
                        </div>
                        <div class="w-100 mb-3">
                            <label for="bank_account_number">Account Number</label>
                            <input wire:model.defer="bank_account.account_number" type="text" name="bank_account_number" class="form-control" required>
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
                        <button type="submit" wire:loading.attr="disabled" id="btn-process" class="btn btn-primary">Update</button>
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
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
    
    document.addEventListener('livewire:load', function () {
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                preConfirm: async () => {
                    var data = await @this.delete(id)
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
        
        setTimeout(function() {
            Swal.fire({
                icon: 'success',
                title: event.detail.title,
                text: event.detail.message,
            });
        }, 600);
    })
</script> 
@endpush
