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
            'name' => 'Arts and Humanities'
        ]);

        DB::table('catalogs')->insert([
            'name' => 'Business'
        ]);

        DB::table('catalogs')->insert([
            'name' => 'Computer Science'
        ]);

        DB::table('catalogs')->insert([
            'name' => 'Data Science'
        ]);

        DB::table('catalogs')->insert([
            'name' => 'Information Technology'
        ]);

        DB::table('catalogs')->insert([
            'name' => 'Health'
        ]);

        DB::table('catalogs')->insert([
            'name' => 'Physical Science and Engineering'
        ]);

        DB::table('catalogs')->insert([
            'name' => 'Social Sciences'
        ]);

        DB::table('catalogs')->insert([
            'name' => 'Language Learning'
        ]);
    }
}
