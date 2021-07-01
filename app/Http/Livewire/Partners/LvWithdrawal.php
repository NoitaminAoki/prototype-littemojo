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
    public $bank_accounts = [];
    public $has_bank;
    public $amount;
    public $max_amount;
    
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
        $can_add_withdrawal = true;
        $last_withdrawal = PartnerWithdrawal::where('partner_id', $user_auth->id)
        ->whereIn('status', ['pending', 'process'])
        ->first();

        if($last_withdrawal) {
            $can_add_withdrawal = false;
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
        ->orderBy('status_number')
        ->get();
        
        $this->bank_accounts = BankAccount::where('partner_id', $user_auth->id)->get();

        return view('partners.withdrawal.lv_index')
        ->with(['withdrawals' => $withdrawals, 'can_add_withdrawal' => $can_add_withdrawal])
        ->layout('partners.layouts.app-main');
    }
    
    public function resetInput()
    {
        $user_auth = Auth::guard('partner')->user();
        $this->reset(['withdrawal', 'amount']);
        $account = BankAccount::where(['partner_id' => $user_auth->id, 'is_main_bank' => 1])->first();
        if ($account) {
            $this->bank_account['id'] = $account->id;
            $this->bank_account['name'] = $account->bank_name;
            $this->bank_account['account_name'] = $account->bank_account_name;
            $this->bank_account['account_number'] = $account->bank_account_number;
            
            $this->has_bank = true;
        }
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

    public function setBankAccount($id)
    {
        $account = BankAccount::findOrFail($id);
        $this->bank_account['id'] = $account->id;
        $this->bank_account['name'] = $account->bank_name;
        $this->bank_account['account_name'] = $account->bank_account_name;
        $this->bank_account['account_number'] = $account->bank_account_number;
        $this->bank_account['is_main_bank'] = $account->is_main_bank;
        return $this->dispatchBrowserEvent('modal:close', ['target' => '#modal-list-bank']);
    }

    public function setWithdrawal($id)
    {
        $user_auth = Auth::guard('partner')->user();
        $withdrawal = PartnerWithdrawal::select('partner_withdrawals.*', 'pbi.bank_name', 'pbi.bank_account_name', 'pbi.bank_account_number', 'pbi.is_main_bank')
        ->where(['partner_withdrawals.id' => $id , 'partner_withdrawals.partner_id' => $user_auth->id])
        ->leftJoin('partner_bank_information as pbi', 'pbi.id', 'partner_withdrawals.bank_id')
        ->first();

        if(!$withdrawal) {
            abort(404);
        }
        // dd($withdrawal);
        $this->withdrawal = $withdrawal;
        $this->amount = $withdrawal->amount;
        $this->bank_account['id'] = $withdrawal->bank_id;
        $this->bank_account['name'] = $withdrawal->bank_name;
        $this->bank_account['account_name'] = $withdrawal->bank_account_name;
        $this->bank_account['account_number'] = $withdrawal->bank_account_number;
        $this->bank_account['is_main_bank'] = $withdrawal->is_main_bank;
    }

    public function update()
    {
        $user_auth = Auth::guard('partner')->user();
        $withdrawal = PartnerWithdrawal::select('partner_withdrawals.*', 'pbi.bank_name', 'pbi.bank_account_name', 'pbi.bank_account_number', 'pbi.is_main_bank')
        ->where(['partner_withdrawals.id' => $this->withdrawal->id , 'partner_withdrawals.partner_id' => $user_auth->id])
        ->leftJoin('partner_bank_information as pbi', 'pbi.id', 'partner_withdrawals.bank_id')
        ->first();

        if(!$withdrawal) {
            abort(404);
        }
        $this->validate([
            'bank_account.name' => 'required|string',
            'bank_account.account_name' => 'required|string',
            'bank_account.account_number' => 'required|string',
            'amount' => 'required|numeric|min:10000',
        ]);
        $withdrawal->bank_id = $this->bank_account['id'];
        $withdrawal->amount = $this->amount;
        $withdrawal->save();
        $this->resetInput();
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully updating data.']);
    }
}
