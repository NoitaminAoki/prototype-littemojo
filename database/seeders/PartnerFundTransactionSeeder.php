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
			'created_at' => "2021-03-01 12:00:00",
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 2,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => "2021-03-05 12:00:00",
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 3,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => "2021-03-13 12:00:00",
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 4,
            'type_transaction' => "income",
            'amount' => 485000,
            'final_amount' => 485000,
			'created_at' => "2021-03-20 12:00:00",
        ]);
        

        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 5,
            'type_transaction' => "income",
            'amount' => 589000,
            'final_amount' => 589000,
			'created_at' => "2021-03-01 12:00:00",
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 6,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => "2021-03-07 12:00:00",
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 7,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => "2021-03-15 12:00:00",
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 8,
            'type_transaction' => "income",
            'amount' => 485000,
            'final_amount' => 485000,
			'created_at' => "2021-03-25 12:00:00",
        ]);
        

        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 9,
            'type_transaction' => "income",
            'amount' => 589000,
            'final_amount' => 589000,
			'created_at' => "2021-03-04 12:00:00",
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 10,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => "2021-03-11 12:00:00",
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 11,
            'type_transaction' => "income",
            'amount' => 295000,
            'final_amount' => 295000,
			'created_at' => "2021-03-15 12:00:00",
        ]);
        DB::table('partner_fund_transactions')->insert([
            'partner_id' => 2,
            'customer_transaction_id' => 12,
            'type_transaction' => "income",
            'amount' => 485000,
            'final_amount' => 485000,
			'created_at' => "2021-03-20 12:00:00",
        ]);
        
    }
}
