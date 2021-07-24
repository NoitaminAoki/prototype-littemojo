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
    .loading-image-block {
        width: 100%;
        height: 200px;
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

    .custom-bg-light {
        background-color: #edeff1!important;
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

@section('Page-Header', 'History - Transaction')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item">History</li>
<li class="breadcrumb-item active">Transaction</li>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-4 col-sm-6">
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
            <div class="col-md-4 col-sm-6">
                <div class="info-box bg-teal">
                    <span class="info-box-icon"><i class="fas fa-sign-in-alt"></i></span>
                    
                    <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number">IDR {{number_format($finance_income, 0, ',', '.')}}</span>
                        
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="info-box bg-maroon">
                    <span class="info-box-icon"><i class="fas fa-sign-out-alt"></i></span>
                    
                    <div class="info-box-content">
                        <span class="info-box-text">Withdrawals</span>
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
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="align-top" rowspan="1" width="20px;">No</th>
                            <th class="align-middle text-center" colspan="5">Date</th>
                        </tr>
                        {{-- <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">ID</th>
                            <th class="align-middle">Type</th>
                            <th class="align-middle">test</th>
                            <th class="align-middle text-center" width="150px;">Amount</th>
                        </tr> --}}
                    </thead>
                    <tbody>
                        @forelse ($history_transactions as $key => $history_items)
                        @php
                            $sub_total_income = $history_items->where('type_transaction', 'income')->sum('amount');
                            $sub_total_outcome = $history_items->where('type_transaction', 'outcome')->sum('amount');
                            $total_fund = $sub_total_income - $sub_total_outcome;
                        @endphp
                        <tr>
                            <td rowspan="{{$history_items->count()+5}}">{{$loop->index+1}}</td>
                            <td class="font-weight-bold" colspan="5">{{$key}}</td>
                        </tr>
                        <tr class="custom-bg-light">
                            <td class="align-middle" width="20px;">No</td>
                            <td class="align-middle">ID</td>
                            <td class="align-middle">Type</td>
                            <td class="align-middle">Time</td>
                            <td class="align-middle text-center" width="150px;">Amount</td>
                        </tr>
                        @foreach ($history_items as $transaction)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>
                                @if ($transaction->type_transaction == 'income')
                                {{$transaction->customerTransaction->transaction_code}}
                                @else
                                {{$transaction->withdrawal->withdrawal_code}}
                                @endif
                            </td>
                            <td>
                                @if ($transaction->type_transaction == 'income')
                                    Sales
                                @else
                                    Withdrawal
                                @endif
                            </td>
                            <td><small class="text-muted">{{date_format( date_create($transaction->created_at_p7), 'H:i'  )}}</small></td>
                            <td>IDR {{number_format($transaction->amount, 0, ',', '.')}}</td>
                            {{-- <td class="{{($transaction->type_transaction == 'income')? 'text-success' : 'text-danger'}}">IDR {{number_format($transaction->amount, 0, ',', '.')}}</td> --}}
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">Sales :</td>
                            <td>IDR {{number_format($sub_total_income, 0, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Withdrawal :</td>
                            <td>IDR {{number_format($sub_total_outcome, 0, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Total :</td>
                            @if ($total_fund > 0)
                            <td class="text-primary"><i class="fas fa-caret-up"></i> IDR {{number_format($total_fund, 0, ',', '.')}}</td>
                            @elseif($total_fund == 0)
                            <td class="text-warning"><i class="fas fa-caret-left"></i> IDR {{number_format($total_fund, 0, ',', '.')}}</td>
                            @else
                            <td class="text-danger"><i class="fas fa-caret-down"></i> IDR {{number_format(abs($total_fund), 0, ',', '.')}}</td>
                            @endif
                        </tr>
                        @empty
                        
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>


@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script>
    
    document.addEventListener('livewire:load', function () {
    })
</script> 
@endpush
