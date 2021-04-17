<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partners')->insert([
            'name' => "Partner 1",
            'email' => "partner1@mail.com",
            'is_verified_by_admin' => true,
            'password' => bcrypt('Password123')
        ]);
        
        DB::table('partners')->insert([
            'name' => "Partner 2",
            'email' => "partner2@mail.com",
            'is_verified_by_admin' => false,
            'password' => bcrypt('Password123')
        ]);
    }
}
