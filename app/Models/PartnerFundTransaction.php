<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    CustomerTransaction,
    PartnerWithdrawal,
};

class PartnerFundTransaction extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'partner_id',
        'customer_transaction_id',
        'partner_withdrawal_id',
        'type_transaction',
        'amount',
        'final_amount',
    ];

    public function customerTransaction()
    {
        return $this->belongsTo(CustomerTransaction::class, 'customer_transaction_id');
    }

    public function withdrawal()
    {
        return $this->belongsTo(PartnerWithdrawal::class, 'partner_withdrawal_id');
    }
}
