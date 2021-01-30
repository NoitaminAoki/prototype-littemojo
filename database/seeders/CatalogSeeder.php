<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('catalogs')->insert([
            ['name' => 'Arts and Humanities'],
            ['name' => 'Business'],
            ['name' => 'Computer Science'],
            ['name' => 'Data Science'],
            ['name' => 'Information Technology'],
            ['name' => 'Health'],
            ['name' => 'Physical Science and Engineering'],
            ['name' => 'Social Sciences'],
            ['name' => 'Language Learning'],
        ]);
    }
}
