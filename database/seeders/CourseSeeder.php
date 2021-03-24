<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CatalogTopic as Topic;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$prices = [100000, 150000, 250000, 50000, 750000, 1990000, 550000, 860000];

		\DB::table('courses')->insert([
			'user_id' => 2,
			'catalog_id' => 4,
			'catalog_topic_id' => 11,
			'level_id' => rand(1,3),
			'title' => 'Big Data using Python',
			'description' => '<h1>Deskripsi 1</h1><h2>Deskripsi 2</h2><h3>Deskripsi 3</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam doloremque dignissimos accusamus nesciunt neque, adipisci, dolor vero assumenda quisquam laudantium libero ea, voluptas expedita ipsa veritatis, fuga nisi quia mollitia.<br></p>',
			'price' => 589000,
			'duration' => 'week',
			'cover' => 'cover_course.jpg',
			'uuid'  => '12538466-84d3-9782-95f2-902d3348ddc3',
			'is_verified' => 1,
			'is_published' => 1,
		]);

		\DB::table('courses')->insert([
			'user_id' => 2,
			'catalog_id' => 4,
			'catalog_topic_id' => 12,
			'level_id' => rand(1,3),
			'title' => 'Make Flappy Bird AI Machine Learning',
			'description' => '<h1>Deskripsi 1</h1><h2>Deskripsi 2</h2><h3>Deskripsi 3</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam doloremque dignissimos accusamus nesciunt neque, adipisci, dolor vero assumenda quisquam laudantium libero ea, voluptas expedita ipsa veritatis, fuga nisi quia mollitia.<br></p>',
			'price' => 295000,
			'duration' => 'week',
			'cover' => 'cover_course.jpg',
			'uuid'  => '12538236-08d3-5847-86b2-902d3348kkf9',
			'is_verified' => 1,
			'is_published' => 1,
		]);

		for ($i=0; $i < 10; ++$i) { 
			$catalog_topics = Topic::where('catalog_id', $i)->orderBy('id', 'asc')->get();
			foreach ($catalog_topics as $key => $topic) {
				
				\DB::table('courses')->insert([
					'user_id' => 1,
					'catalog_id' => $i,
					'catalog_topic_id' => $topic->id,
					'level_id' => rand(1,3),
					'title' => $topic->name.' for '.$topic->catalog->name,
					'description' => '<h1>Deskripsi 1</h1><h2>Deskripsi 2</h2><h3>Deskripsi 3</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam doloremque dignissimos accusamus nesciunt neque, adipisci, dolor vero assumenda quisquam laudantium libero ea, voluptas expedita ipsa veritatis, fuga nisi quia mollitia.<br></p>',
					'price' => $prices[rand(0, count($prices)-1)],
					'duration' => 'month',
					'cover' => Date('YmdHis').'_Ini_title_business_covers.jpg',
					'uuid'  => \Str::uuid()
				]);

			}
		}
    }
}
