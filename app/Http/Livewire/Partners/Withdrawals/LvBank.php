<?php

namespace App\Http\Livewire\Partners\Withdrawals;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    PartnerBankInformation as BankAccount,
};

class LvBank extends Component
{
    protected $rules = [
        'bank_account.name' => 'required|string',
        'bank_account.account_name' => 'required|string',
        'bank_account.account_number' => 'required|string',
    ];
    
    public $bank_account;
    public $is_main_bank = false;
    
    public $notification = [
        'isOpen' => false, 
        'message' => "",
    ];
    
    public function mount()
    {
        
    }
    
    public function render()
    {
        $user_auth = Auth::guard('partner')->user();
        $bank_accounts = BankAccount::where('partner_id', $user_auth->id)->get();
        
        return view('partners.withdrawal.bank_account.lv_bank_index')
        ->with(['bank_accounts' => $bank_accounts])
        ->layout('partners.layouts.app-main');
        
    }

    public function resetInput()
    {
        $this->reset(['bank_account', 'is_main_bank']);
    }

    public function insert()
    {
        $user_auth = Auth::guard('partner')->user();
        $this->validate([
            'bank_account.name' => 'required|string',
            'bank_account.account_name' => 'required|string',
            'bank_account.account_number' => 'required|string',
        ]);
        $data = [];
        $data['partner_id'] = $user_auth->id;
        $data['bank_name'] = $this->bank_account['name'];
        $data['bank_account_name'] = $this->bank_account['account_name'];
        $data['bank_account_number'] = $this->bank_account['account_number'];

        $count = BankAccount::count();
        if($count == 0) {
            $data['is_main_bank'] = true;
        }
        $account = BankAccount::insert($data);
        $this->resetInput();
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully adding data.']);
    }

    public function setBank($id)
    {
        $account = BankAccount::findOrFail($id);
        $this->bank_account['id'] = $account->id;
        $this->bank_account['name'] = $account->bank_name;
        $this->bank_account['account_name'] = $account->bank_account_name;
        $this->bank_account['account_number'] = $account->bank_account_number;
        $this->bank_account['is_main_bank'] = $account->is_main_bank;
        $this->is_main_bank = $account->is_main_bank;
    }

    public function update()
    {
        $this->validate([
            'bank_account.name' => 'required|string',
            'bank_account.account_name' => 'required|string',
            'bank_account.account_number' => 'required|string',
            'bank_account.is_main_bank' => 'required|boolean',
        ]);
        $account = BankAccount::findOrFail($this->bank_account['id']);
        $account->bank_name = $this->bank_account['name'];
        $account->bank_account_name = $this->bank_account['account_name'];
        $account->bank_account_number = $this->bank_account['account_number'];
        if(!$account->is_main_bank && $this->bank_account['is_main_bank']) {
            $account->is_main_bank = $this->bank_account['is_main_bank'];
            $update = BankAccount::where('is_main_bank', true)->update(['is_main_bank' => false]);
        }
        $account->save();
        $this->resetInput();
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully updating data.']);
    }

    public function delete($id)
    {
        $account = BankAccount::findOrFail($id);
        if($account->is_main_bank) {
            return ['status_code' => 403, 'message' => 'Unable to delete your main Bank Account.'];
        }
        $account->delete();
        return ['status_code' => 200, 'message' => 'Your file has been deleted.'];
    }
}
