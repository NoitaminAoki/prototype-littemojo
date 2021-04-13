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
			'created_at' => date('Y-m-01 H:i:s'),
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 2,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => date('Y-m-05 H:i:s'),
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 3,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => date('Y-m-13 H:i:s'),
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 4,
            'type_transaction' => "income",
            'amount' => 485000,
            'final_amount' => 485000,
			'created_at' => date('Y-m-20 H:i:s'),
        ]);
        

        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 5,
            'type_transaction' => "income",
            'amount' => 589000,
            'final_amount' => 589000,
			'created_at' => date('Y-m-01 H:i:s'),
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 6,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => date('Y-m-07 H:i:s'),
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 7,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => date('Y-m-15 H:i:s'),
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 8,
            'type_transaction' => "income",
            'amount' => 485000,
            'final_amount' => 485000,
			'created_at' => date('Y-m-25 H:i:s'),
        ]);
        

        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 9,
            'type_transaction' => "income",
            'amount' => 589000,
            'final_amount' => 589000,
			'created_at' => date('Y-m-04 H:i:s'),
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 10,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => date('Y-m-11 H:i:s'),
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 11,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => date('Y-m-15 H:i:s'),
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 12,
            'type_transaction' => "income",
            'amount' => 485000,
            'final_amount' => 485000,
			'created_at' => date('Y-m-20 H:i:s'),
        ]);
        
    }
}
