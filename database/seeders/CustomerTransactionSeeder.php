<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_transactions')->insert([
            'customer_id' => 3,
            'course_id' => 1,
            'transaction_code' => "TRX20210101C189721",
            'price' => 589000,
            'admin_fee' => 0,
            'total_price' => 589000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "success",
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 3,
            'course_id' => 2,
            'transaction_code' => "TRX20210102C269129",
            'price' => 295000,
            'admin_fee' => 0,
            'total_price' => 295000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "success",
        ]);
    }
}
