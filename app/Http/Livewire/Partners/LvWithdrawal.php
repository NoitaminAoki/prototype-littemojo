<?php

namespace App\Http\Livewire\Partners;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\{
    PartnerFundTransaction as FundTransaction,
    PartnerWithdrawal,
    PartnerBankInformation as BankAccount,
};
use DB;

class LvWithdrawal extends Component
{
    public $withdrawal;
    
    public $bank_account;
    public $has_bank;
    public $amount;
    public $max_amount;
    public $can_add_withdrawal = false;
    
    public function mount()
    {
        $user_auth = Auth::guard('partner')->user();
        $account = BankAccount::where(['partner_id' => $user_auth->id, 'is_main_bank' => 1])->first();
        if ($account) {
            $this->bank_account['id'] = $account->id;
            $this->bank_account['name'] = $account->bank_name;
            $this->bank_account['account_name'] = $account->bank_account_name;
            $this->bank_account['account_number'] = $account->bank_account_number;
            
            $this->has_bank = true;
        }
    }
    
    public function render()
    {
        $user_auth = Auth::guard('partner')->user();

        $last_withdrawal = PartnerWithdrawal::where('partner_id', $user_auth->id)
        ->whereNotIn('status', ['pending', 'process'])
        ->first();

        if($last_withdrawal) {
            $this->can_add_withdrawal = true;
        }
        
        $total_income = FundTransaction::select(DB::raw('SUM(amount) as total_amount'))
        ->leftJoin('customer_transactions as ct', 'ct.id', 'partner_fund_transactions.customer_transaction_id')
        ->where([['partner_id', $user_auth->id], ['type_transaction', 'income'], ['ct.status_payment', 'settlement']])
        ->value('total_amount');
        $total_outcome = FundTransaction::select(DB::raw('SUM(amount) as total_amount'))
        ->where([['partner_id', $user_auth->id], ['type_transaction', 'outcome']])
        ->value('total_amount');

        $this->max_amount = $total_income - $total_outcome;

        $withdrawals = PartnerWithdrawal::select('*')
        ->selectRaw("CASE status
        WHEN 'pending' THEN 0
        WHEN 'process' THEN 1
        WHEN 'success' THEN 2
        END as status_number")
        ->where('partner_id', $user_auth->id)
        ->get();
        
        return view('partners.withdrawal.lv_index')
        ->with(['withdrawals' => $withdrawals])
        ->layout('partners.layouts.app-main');
    }
    
    public function resetInput()
    {
        $this->reset(['withdrawal', 'amount']);
    }

    public function insert()
    {
        $user_auth = Auth::guard('partner')->user();
        $last_withdrawal = PartnerWithdrawal::where('partner_id', $user_auth->id)
        ->whereIn('status', ['pending', 'process'])
        ->first();

        $total_income = FundTransaction::select(DB::raw('SUM(amount) as total_amount'))
        ->leftJoin('customer_transactions as ct', 'ct.id', 'partner_fund_transactions.customer_transaction_id')
        ->where([['partner_id', $user_auth->id], ['type_transaction', 'income'], ['ct.status_payment', 'settlement']])
        ->value('total_amount');
        $total_outcome = FundTransaction::select(DB::raw('SUM(amount) as total_amount'))
        ->where([['partner_id', $user_auth->id], ['type_transaction', 'outcome']])
        ->value('total_amount');

        $max_amount = $total_income - $total_outcome;
        
        if($last_withdrawal) {
            return $this->dispatchBrowserEvent('notification:error', ['title' => 'Failed!', 'message' => 'Previous withdrawal are still being processed.']);
        }
        
        if($max_amount < $this->amount) {
            return $this->dispatchBrowserEvent('notification:error', ['title' => 'Sorry!', 'message' => 'Your balance is not enough.']);
        }

        $this->validate([
            'bank_account.name' => 'required|string',
            'bank_account.account_name' => 'required|string',
            'bank_account.account_number' => 'required|string',
            'amount' => 'required|numeric|min:10000',
        ]);
        $data = [];
        $data['partner_id'] = $user_auth->id;
        $data['bank_id'] = $this->bank_account['id'];
        $data['uuid'] = Str::uuid();
        $data['amount'] = $this->amount;
        $data['status'] = 'pending';

        $withdrawal = PartnerWithdrawal::insert($data);
        $this->resetInput();
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully adding data.']);
    }
}
