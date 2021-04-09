<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransactionDetail extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'customer_id',
        'customer_transaction_id',
        'midtrans_transaction_id',
        'order_id',
        'total_amount',
        'payment_type',
        'payment_type_readable',
        'bank',
        'va_number',
        'bill_key',
        'biller_code',
        'payment_code',
        'link_pdf_payment_method',
        'transaction_time',
        'transaction_status',
    ];
}
