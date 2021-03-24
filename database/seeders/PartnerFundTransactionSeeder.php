<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerFundTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 1,
            'type_transaction' => "income",
            'amount' => 589000,
            'final_amount' => 589000,
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 2,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
        ]);
    }
}
