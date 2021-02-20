<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\DB::table('catalog_topics')->insert([
    		'catalog_id' => 2,
    		'name' => 'Catalog Topic Business'
    	]);

    	
    	\DB::table('courses')->insert([
    		'user_id' => 1,
    		'catalog_id' => 2,
    		'catalog_topic_id' => 1,
    		'level_id' => 2,
    		'title' => 'Ini title business',
    		'description' => '<h1>Deskripsi 1</h1><h2>Deskripsi 2</h2><h3>Deskripsi 3</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam doloremque dignissimos accusamus nesciunt neque, adipisci, dolor vero assumenda quisquam laudantium libero ea, voluptas expedita ipsa veritatis, fuga nisi quia mollitia.<br></p>',
    		'price' => 100000,
    		'duration' => 'month',
            'cover' => Date('YmdHis').'Ini title business_covers.jpg'
    	]);

    	\DB::table('course_lessons')->insert([
    		'course_id' => 1,
    		'title' => 'Lesson business',
    		'description' => 'Ini Lesson business gann'
    	]);
    }
}
