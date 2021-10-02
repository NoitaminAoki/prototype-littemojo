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
			'level_id' => 2,
			'title' => 'Big Data using Python',
			'slug_title' => \Str::slug('Big Data using Python'),
			'description' => "<p>This course is the first of a series that aims to prepare you for a role as an entry-level IT Support Specialist. In this course, you’ll be introduced to the world of Information Technology, or IT. You’ll learn about the different facets of Information Technology, like computer hardware, the Internet, computer software, troubleshooting, and customer service. This course covers a wide variety of topics in IT that are designed to give you an overview of what’s to come in this certificate program.</p><p><br>By the end of this course, you’ll be able to:<br>● understand how the binary system works<br>● assemble a computer from scratch<br>● choose and install an operating system on a computer<br>● understand what the Internet is, how it works, and the impact it has in the modern world<br>● learn how applications are created and how they work under the hood of a computer<br>● utilize common problem-solving methodologies and soft skills in an Information Technology setting</p>",
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
			'level_id' => 1,
			'title' => 'Flappy Bird AI Machine Learning with C#',
			'slug_title' => \Str::slug('Flappy Bird AI Machine Learning with C#'),
			'description' => "<p>This course is the first of a series that aims to prepare you for a role as an entry-level IT Support Specialist. In this course, you’ll be introduced to the world of Information Technology, or IT. You’ll learn about the different facets of Information Technology, like computer hardware, the Internet, computer software, troubleshooting, and customer service. This course covers a wide variety of topics in IT that are designed to give you an overview of what’s to come in this certificate program.</p><p><br>By the end of this course, you’ll be able to:<br>● understand how the binary system works<br>● assemble a computer from scratch<br>● choose and install an operating system on a computer<br>● understand what the Internet is, how it works, and the impact it has in the modern world<br>● learn how applications are created and how they work under the hood of a computer<br>● utilize common problem-solving methodologies and soft skills in an Information Technology setting</p>",
			'price' => 295000,
			'duration' => 'week',
			'cover' => 'cover_course.jpg',
			'uuid'  => '12538236-08d3-5847-86b2-902d3348kkf9',
			'is_verified' => 1,
			'is_published' => 1,
		]);

		\DB::table('courses')->insert([
			'user_id' => 2,
			'catalog_id' => 4,
			'catalog_topic_id' => 12,
			'level_id' => 1,
			'title' => 'Flappy Bird AI Machine Learning with Python',
			'slug_title' => \Str::slug('Flappy Bird AI Machine Learning with Python'),
			'description' => "<p>This course is the first of a series that aims to prepare you for a role as an entry-level IT Support Specialist. In this course, you’ll be introduced to the world of Information Technology, or IT. You’ll learn about the different facets of Information Technology, like computer hardware, the Internet, computer software, troubleshooting, and customer service. This course covers a wide variety of topics in IT that are designed to give you an overview of what’s to come in this certificate program.</p><p><br>By the end of this course, you’ll be able to:<br>● understand how the binary system works<br>● assemble a computer from scratch<br>● choose and install an operating system on a computer<br>● understand what the Internet is, how it works, and the impact it has in the modern world<br>● learn how applications are created and how they work under the hood of a computer<br>● utilize common problem-solving methodologies and soft skills in an Information Technology setting</p>",
			'price' => 295000,
			'duration' => 'week',
			'cover' => 'cover_course.jpg',
			'uuid'  => '12538236-08d3-5847-86b2-902d3348kkf9',
			'is_verified' => 1,
			'is_published' => 1,
		]);

		\DB::table('courses')->insert([
			'user_id' => 2,
			'catalog_id' => 5,
			'catalog_topic_id' => 14,
			'level_id' => 1,
			'title' => 'Settings Server for Your Online Games',
			'slug_title' => \Str::slug('Settings Server for Your Online Games'),
			'description' => "<p>This course is the first of a series that aims to prepare you for a role as an entry-level IT Support Specialist. In this course, you’ll be introduced to the world of Information Technology, or IT. You’ll learn about the different facets of Information Technology, like computer hardware, the Internet, computer software, troubleshooting, and customer service. This course covers a wide variety of topics in IT that are designed to give you an overview of what’s to come in this certificate program.</p><p><br>By the end of this course, you’ll be able to:<br>● understand how the binary system works<br>● assemble a computer from scratch<br>● choose and install an operating system on a computer<br>● understand what the Internet is, how it works, and the impact it has in the modern world<br>● learn how applications are created and how they work under the hood of a computer<br>● utilize common problem-solving methodologies and soft skills in an Information Technology setting</p>",
			'price' => 485000,
			'duration' => 'week',
			'cover' => 'cover_course.jpg',
			'uuid'  => '12538236-08d3-5847-86b2-902d3348kkf9',
			'is_verified' => 1,
			'is_published' => 1,
		]);

		\DB::table('courses')->insert([
			'user_id' => 2,
			'catalog_id' => 5,
			'catalog_topic_id' => 17,
			'level_id' => 1,
			'title' => 'Technical Support Fundamentals',
			'slug_title' => \Str::slug('Technical Support Fundamentals'),
			'description' => "<p>This course is the first of a series that aims to prepare you for a role as an entry-level IT Support Specialist. In this course, you’ll be introduced to the world of Information Technology, or IT. You’ll learn about the different facets of Information Technology, like computer hardware, the Internet, computer software, troubleshooting, and customer service. This course covers a wide variety of topics in IT that are designed to give you an overview of what’s to come in this certificate program.</p><p><br>By the end of this course, you’ll be able to:<br>● understand how the binary system works<br>● assemble a computer from scratch<br>● choose and install an operating system on a computer<br>● understand what the Internet is, how it works, and the impact it has in the modern world<br>● learn how applications are created and how they work under the hood of a computer<br>● utilize common problem-solving methodologies and soft skills in an Information Technology setting</p>",
			'price' => 485000,
			'duration' => 'week',
			'cover' => 'cover_course.jpg',
			'uuid'  => '12538236-08d3-5847-86b2-902d3348kkf9',
			'is_verified' => 1,
			'is_published' => 1,
		]);

		// for ($i=0; $i < 10; ++$i) { 
		// 	$catalog_topics = Topic::where('catalog_id', $i)->orderBy('id', 'asc')->get();
		// 	foreach ($catalog_topics as $key => $topic) {
				
		// 		\DB::table('courses')->insert([
		// 			'user_id' => 1,
		// 			'catalog_id' => $i,
		// 			'catalog_topic_id' => $topic->id,
		// 			'level_id' => rand(1,3),
		// 			'title' => $topic->name.' for '.$topic->catalog->name,
		// 			'description' => "<p>This course is the first of a series that aims to prepare you for a role as an entry-level IT Support Specialist. In this course, you’ll be introduced to the world of Information Technology, or IT. You’ll learn about the different facets of Information Technology, like computer hardware, the Internet, computer software, troubleshooting, and customer service. This course covers a wide variety of topics in IT that are designed to give you an overview of what’s to come in this certificate program.</p><p><br>By the end of this course, you’ll be able to:<br>● understand how the binary system works<br>● assemble a computer from scratch<br>● choose and install an operating system on a computer<br>● understand what the Internet is, how it works, and the impact it has in the modern world<br>● learn how applications are created and how they work under the hood of a computer<br>● utilize common problem-solving methodologies and soft skills in an Information Technology setting</p>",
		// 			'price' => $prices[rand(0, count($prices)-1)],
		// 			'duration' => 'month',
		// 			'cover' => Date('YmdHis').'_Ini_title_business_covers.jpg',
		// 			'uuid'  => \Str::uuid()
		// 		]);

		// 	}
		// }
    }
}
