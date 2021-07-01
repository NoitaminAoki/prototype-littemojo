<?php

namespace App\Http\Livewire\Admins;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\{
    PartnerFundTransaction as FundTransaction,
    PartnerWithdrawal,
    PartnerBankInformation as BankAccount,
};
use DB;

class LvRequestWithdrawal extends Component
{
    public $bank_account;
    
    public function mount()
    {
        # code...
    }
    
    public function render()
    {
        $total_income = FundTransaction::select(DB::raw('SUM(amount) as total_amount'))
        ->leftJoin('customer_transactions as ct', 'ct.id', 'partner_fund_transactions.customer_transaction_id')
        ->where([['type_transaction', 'income'], ['ct.status_payment', 'settlement']])
        ->value('total_amount');
        $total_outcome = FundTransaction::select(DB::raw('SUM(amount) as total_amount'))
        ->where('type_transaction', 'outcome')
        ->value('total_amount');
        
        $total_request = PartnerWithdrawal::select(DB::raw('SUM(amount) as total_amount'))
        ->where('status', ['pending', 'process'])
        ->value('total_amount');
        
        $remaining_balances = $total_income - $total_outcome;
        
        $withdrawals = PartnerWithdrawal::select('*')
        ->selectRaw("CASE status
        WHEN 'pending' THEN 0
        WHEN 'process' THEN 1
        END as status_number")
        ->whereIn('status', ['pending', 'process'])
        ->orderBy('status_number')
        ->get();
        
        $data = [
            'withdrawals' => $withdrawals, 
            'finance_income' => $total_income, 
            'finance_outcome' => $total_outcome, 
            'finance_remaining_balance' => $remaining_balances,
            'total_request' => $total_request,
        ];
        
        return view('admins.finance.lv_request_withdrawal')
        ->with($data)
        ->layout('admins.layouts.app-main');
    }

    public function acceptRequest($id)
    {
        $withdrawal = PartnerWithdrawal::findOrFail($id);
        $withdrawal->status = 'process';
        $withdrawal->save();
        return ['status_code' => 200, 'message' => 'You have been accepted the request!'];
    }
}
