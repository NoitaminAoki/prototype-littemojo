<?php

namespace App\Http\Livewire\Admins;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\{
    PartnerFundTransaction as FundTransaction,
    PartnerWithdrawal,
    PartnerBankInformation as BankAccount,
    PartnerFundTransaction,
};
use App\Mail\CustomerMail;
use Mail;
use DB;

class LvRequestWithdrawal extends Component
{
    use WithFileUploads;
    
    protected $rules = [
        'file' => 'required|mimes:pdf|max:5120',
    ];

    public $file;
    public $description;
    public $iteration;

    public $withdrawal;
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
        ->whereIn('status', ['pending', 'process'])
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

    public function cancelRequest($id)
    {
        $withdrawal = PartnerWithdrawal::findOrFail($id);
        $withdrawal->status = 'pending';
        $withdrawal->save();
        return ['status_code' => 200, 'message' => 'You have been canceled the process!'];
    }

    public function rejectRequest($id)
    {
        $withdrawal = PartnerWithdrawal::findOrFail($id);
        $withdrawal->status = 'rejected';
        $withdrawal->save();
        return ['status_code' => 200, 'message' => 'You have been rejected the request!'];
    }

    public function setBank($id)
    {
        $account = BankAccount::findOrFail($id);
        $this->bank_account['name'] = $account->bank_name;
        $this->bank_account['account_name'] = $account->bank_account_name;
        $this->bank_account['account_number'] = $account->bank_account_number;
    }

    public function setWithdrawal($id)
    {
        $withdrawal = PartnerWithdrawal::select('partner_withdrawals.*', 'pbi.bank_name', 'pbi.bank_account_name', 'pbi.bank_account_number', 'pbi.is_main_bank')
        ->where('partner_withdrawals.id', $id)
        ->leftJoin('partner_bank_information as pbi', 'pbi.id', 'partner_withdrawals.bank_id')
        ->first();

        if(!$withdrawal) {
            abort(404);
        }
        // dd($withdrawal);
        $this->withdrawal = $withdrawal;
        $this->bank_account['name'] = $withdrawal->bank_name;
        $this->bank_account['account_name'] = $withdrawal->bank_account_name;
        $this->bank_account['account_number'] = $withdrawal->bank_account_number;
    }

    public function finishRequest()
    {
        $this->validate([
            'file' => 'required|image|max:5120'
        ]);
        $withdrawal = PartnerWithdrawal::findOrFail($this->withdrawal->id);
        
        $name = Date('YmdHis').'_request-id_'.$withdrawal->id.'.'.$this->file->extension();
        $path = Storage::putFileAs('images/bank_transfer/partner_'.$withdrawal->partner_id, $this->file, $name);

        $withdrawal->image = $name;
        $withdrawal->path = $path;
        $withdrawal->status = 'success';
        $withdrawal->save();

        
        PartnerFundTransaction::create([
            'partner_id' => $withdrawal->partner_id,
            'partner_withdrawal_id' => $withdrawal->id,
            'type_transaction' => 'outcome',
            'amount' => $withdrawal->amount,
            'final_amount' => $withdrawal->amount,
        ]);

        $this->resetInput();
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'You have been finished the process!']);
    }
    
    public function resetInput()
    {
        $this->reset(['file', 'withdrawal', 'bank_account']);
        $this->iteration++;
    }
}
