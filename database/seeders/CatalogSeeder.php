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

        
    	\DB::table('catalog_topics')->insert([
            
			[
				'catalog_id' => 1,
				'name' => 'History'
			],
			[
				'catalog_id' => 1,
				'name' => 'Music and Art'
			],
			[
				'catalog_id' => 1,
				'name' => 'philosophy'
			],
			[
				'catalog_id' => 2,
				'name' => 'Finance'
			],
			[
				'catalog_id' => 2,
				'name' => 'Marketing'
			],
			[
				'catalog_id' => 2,
				'name' => 'Entrepreneurship'
			],
			[
				'catalog_id' => 3,
				'name' => 'Software Development'
			],
			[
				'catalog_id' => 3,
				'name' => 'Mobile And Web Development'
			],
			[
				'catalog_id' => 3,
				'name' => 'Algorithms'
			],
			[
				'catalog_id' => 3,
				'name' => 'Computer Security And Networks'
			],
			[
				'catalog_id' => 4,
				'name' => 'Data Analysis'
			],
			[
				'catalog_id' => 4,
				'name' => 'Machine Learning'
			],
			[
				'catalog_id' => 4,
				'name' => 'Probability And Statistics'
			],
			[
				'catalog_id' => 5,
				'name' => 'Cloud Computing'
			],
			[
				'catalog_id' => 5,
				'name' => 'Security'
			],
			[
				'catalog_id' => 5,
				'name' => 'Data Management'
			],
			[
				'catalog_id' => 5,
				'name' => 'Networking'
			],
			[
				'catalog_id' => 5,
				'name' => 'Support And Operations'
			],
			[
				'catalog_id' => 6,
				'name' => 'Animal Health'
			],
			[
				'catalog_id' => 6,
				'name' => 'Basic Science'
			],
			[
				'catalog_id' => 6,
				'name' => 'Health Informatics'
			],
			[
				'catalog_id' => 6,
				'name' => 'Public Health'
			],
			[
				'catalog_id' => 6,
				'name' => 'Psychology'
			],
			[
				'catalog_id' => 7,
				'name' => 'Electrical Engineering'
			],
			[
				'catalog_id' => 7,
				'name' => 'Mechanical Engineering'
			],
			[
				'catalog_id' => 7,
				'name' => 'Chemistry'
			],
			[
				'catalog_id' => 7,
				'name' => 'Environmental Science And Sustainability'
			],
			[
				'catalog_id' => 7,
				'name' => 'Research Methods'
			],
			[
				'catalog_id' => 8,
				'name' => 'Economics'
			],
			[
				'catalog_id' => 8,
				'name' => 'Education'
			],
			[
				'catalog_id' => 8,
				'name' => 'Governance And Society'
			],
			[
				'catalog_id' => 8,
				'name' => 'Law'
			],
			[
				'catalog_id' => 9,
				'name' => 'Learning English'
			],
			[
				'catalog_id' => 9,
				'name' => 'Other Languages'
			],
        ]);
    }
}
