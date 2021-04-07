<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransaction extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'customer_id',
        'course_id',
        'transaction_code',
        'price',
        'admin_fee',
        'total_price',
        'snap_token',
        'status_payment',
        'start_date',
    ];
}
