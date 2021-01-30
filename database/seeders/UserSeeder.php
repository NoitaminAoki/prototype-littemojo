<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => "Admin 1",
                'email' => "admin@admin.com",
                'password' => bcrypt('Password123')
            ],
            [
                'name' => 'Bariq Dharmawan',
                'email' => 'sanchez77rodriguez@gmail.com',
                'password' => Hash::make('gakadapassword')
            ]
        ]);

        DB::table('admins')->insert([
            'name' => "Admin 1",
            'email' => "admin@admin.com",
            'password' => bcrypt('Password123')
        ]);
    }
}
