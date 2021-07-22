<?php

namespace App\Http\Livewire\Partners;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    PartnerFundTransaction as FundTransaction,
    PartnerWithdrawal,
    PartnerBankInformation as BankAccount,
};
use DB;

class LvHistoryTransaction extends Component
{
    public function render()
    {
        $user_auth = Auth::guard('partner')->user();

        $total_income = FundTransaction::select(DB::raw('SUM(amount) as total_amount'))
        ->leftJoin('customer_transactions as ct', 'ct.id', 'partner_fund_transactions.customer_transaction_id')
        ->where([['partner_id', $user_auth->id], ['type_transaction', 'income'], ['ct.status_payment', 'settlement']])
        ->value('total_amount');
        $total_outcome = FundTransaction::select(DB::raw('SUM(amount) as total_amount'))
        ->where([['partner_id', $user_auth->id], ['type_transaction', 'outcome']])
        ->value('total_amount');
        
        $remaining_balances = $total_income - $total_outcome;

        $transactions = FundTransaction::select('*', DB::raw("CONVERT_TZ(created_at,'+00:00','+07:00') as created_at_p7, DATE_FORMAT(CONVERT_TZ(created_at,'+00:00','+07:00'), '%d %M %Y') as date"))
        ->where('partner_id', $user_auth->id)
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('date');

        // dd($transactions);
        $data = [
            'history_transactions' => $transactions, 
            'finance_income' => $total_income, 
            'finance_outcome' => $total_outcome, 
            'finance_remaining_balance' => $remaining_balances,
        ];

        return view('partners.history.lv_h_transaction')
        ->with($data)
        ->layout('partners.layouts.app-main');
    }
}
