<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Partner,
    PartnerBankInformation as BankAccount,
};

class PartnerWithdrawal extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'partner_id',
        'bank_id',
        'uuid',
        'image',
        'path',
        'amount',
        'status',
    ];
    
    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class, 'bank_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'bank_id');
    }
}
