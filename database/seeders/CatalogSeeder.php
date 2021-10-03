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
				'name' => 'History',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 1,
				'name' => 'Music and Art',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 1,
				'name' => 'philosophy',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 2,
				'name' => 'Finance',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 2,
				'name' => 'Marketing',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 2,
				'name' => 'Entrepreneurship',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 3,
				'name' => 'Software Development',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 3,
				'name' => 'Mobile And Web Development',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 3,
				'name' => 'Algorithms',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 3,
				'name' => 'Computer Security And Networks',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 4,
				'name' => 'Data Analysis',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 4,
				'name' => 'Machine Learning',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 4,
				'name' => 'Probability And Statistics',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 5,
				'name' => 'Cloud Computing',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 5,
				'name' => 'Security',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 5,
				'name' => 'Data Management',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 5,
				'name' => 'Networking',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 5,
				'name' => 'Support And Operations',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 6,
				'name' => 'Animal Health',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 6,
				'name' => 'Basic Science',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 6,
				'name' => 'Health Informatics',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 6,
				'name' => 'Public Health',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 6,
				'name' => 'Psychology',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 7,
				'name' => 'Electrical Engineering',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 7,
				'name' => 'Mechanical Engineering',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 7,
				'name' => 'Chemistry',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 7,
				'name' => 'Environmental Science And Sustainability',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 7,
				'name' => 'Research Methods',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 8,
				'name' => 'Economics',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 8,
				'name' => 'Education',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 8,
				'name' => 'Governance And Society',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 8,
				'name' => 'Law',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 9,
				'name' => 'Learning English',
				'is_approved' => 1,
			],
			[
				'catalog_id' => 9,
				'name' => 'Other Languages',
				'is_approved' => 1,
			],
        ]);
    }
}
