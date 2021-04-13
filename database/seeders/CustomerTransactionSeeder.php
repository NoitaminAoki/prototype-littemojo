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
            'transaction_code' => "TRX20210301C189721",
            'price' => 589000,
            'admin_fee' => 0,
            'total_price' => 589000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-01 H:i:s'),
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 3,
            'course_id' => 2,
            'transaction_code' => "TRX20210305C264810",
            'price' => 295000,
            'admin_fee' => 0,
            'total_price' => 295000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-05 H:i:s'),
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 3,
            'course_id' => 3,
            'transaction_code' => "TRX20210313C343927",
            'price' => 295000,
            'admin_fee' => 0,
            'total_price' => 295000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-13 H:i:s'),
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 3,
            'course_id' => 4,
            'transaction_code' => "TRX20210320C447201",
            'price' => 485000,
            'admin_fee' => 0,
            'total_price' => 485000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-20 H:i:s'),
        ]);


        DB::table('customer_transactions')->insert([
            'customer_id' => 4,
            'course_id' => 1,
            'transaction_code' => "TRX20210301C187291",
            'price' => 589000,
            'admin_fee' => 0,
            'total_price' => 589000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-01 H:i:s'),
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 4,
            'course_id' => 2,
            'transaction_code' => "TRX20210307C217842",
            'price' => 295000,
            'admin_fee' => 0,
            'total_price' => 295000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-07 H:i:s'),
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 4,
            'course_id' => 3,
            'transaction_code' => "TRX20210315C397402",
            'price' => 295000,
            'admin_fee' => 0,
            'total_price' => 295000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-15 H:i:s'),
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 4,
            'course_id' => 4,
            'transaction_code' => "TRX20210325C428520",
            'price' => 485000,
            'admin_fee' => 0,
            'total_price' => 485000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-25 H:i:s'),
        ]);


        DB::table('customer_transactions')->insert([
            'customer_id' => 5,
            'course_id' => 1,
            'transaction_code' => "TRX20210304C112350",
            'price' => 589000,
            'admin_fee' => 0,
            'total_price' => 589000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-04 H:i:s'),
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 5,
            'course_id' => 2,
            'transaction_code' => "TRX20210311C249172",
            'price' => 295000,
            'admin_fee' => 0,
            'total_price' => 295000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-11 H:i:s'),
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 5,
            'course_id' => 3,
            'transaction_code' => "TRX20210315C385291",
            'price' => 295000,
            'admin_fee' => 0,
            'total_price' => 295000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-15 H:i:s'),
        ]);
        DB::table('customer_transactions')->insert([
            'customer_id' => 5,
            'course_id' => 4,
            'transaction_code' => "TRX20210320C423568",
            'price' => 485000,
            'admin_fee' => 0,
            'total_price' => 485000,
            'promo_id' => null,
            'snap_token' => null,
            'status_payment' => "settlement",
			'created_at' => date('Y-m-13 H:i:s'),
        ]);
    }
}
