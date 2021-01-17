<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'name' => 'Beginner Level',
            'difficulty' => 1,
            'description' => 'No degree or prior experience required.'
        ]);

        DB::table('levels')->insert([
            'name' => 'Intermediate Level',
            'difficulty' => 2,
            'description' => 'Some related experience required.'
        ]);

        DB::table('levels')->insert([
            'name' => 'Advanced Level',
            'difficulty' => 3,
            'description' => 'Designed for those already in the industry.'
        ]);

    }
}
