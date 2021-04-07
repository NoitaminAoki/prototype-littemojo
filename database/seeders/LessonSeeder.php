<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Introduction to IT
        $desc_1 = <<<EOT
        Welcome to Technical Support Fundamentals, the first course of the IT Support Professional Certificate! By enrolling in this course, you are taking the first step to kickstarting your career in tech. In the first week of the course, we'll learn about how computers were invented, how they've evolved over time, and how they work today. We will also learn about what an "IT Support Specialist" is and what they do in their job. By the end of this module, you will know how to count like a computer using binary and understand why these calculations are so powerful for society. So let's get started! 
        EOT;

        //Overview of Cloud Computing
        $desc_2 = <<<EOT
        This lesson you will learn about the definition and essential characteristics of cloud computing. You will learn about the evolution of cloud computing, the emerging technologies supported by cloud, and the business case for cloud computing.In this module, you will learn about the definition and essential characteristics of cloud computing. You will also learn about the evolution of cloud computing, the business case for cloud adoption, and how some of the emerging technologies are being supported by cloud computing.
        EOT;
        
        //What is AI? Applications and Examples of AI
        $desc_3 = <<<EOT
        This lesson, you will learn what AI is. You will understand its applications and use cases and how it is transforming our lives.
        EOT;

        //Networking
        $desc_4 = <<<EOT
        In the fourth lesson of this course, we'll learn about computer networking. We'll explore the history of the Internet and what "The Web" actually is. We'll also discuss topics like Internet privacy, security, and what the future of the Internet may look like. You'll also understand why the Internet has limitations even today. By the end of this module, you will know how the Internet works and recognize both the positive and negative impacts the Internet has had on the world.
        EOT;

        //Troubleshooting
        $desc_5 = <<<EOT
        Congratulations, you've made it to the last week of the course! In the final week, we'll learn about the importance of troubleshooting and customer support. We'll go through some real-world scenarios that you might encounter at a Help Desk or Desktop Support role. We'll learn why empathizing with a user is super important when working in a tech role. Finally, we'll learn why writing documentation is an important aspect of any IT role. By the end of this module, you will utilize soft skills and write documentation to communicate with others.
        EOT;

        // $desc_1 = addslashes($desc_1);
        // $desc_2 = addslashes($desc_2);
        // $desc_3 = addslashes($desc_3);
        // $desc_4 = addslashes($desc_4);
        // $desc_5 = addslashes($desc_5);

        DB::table('course_lessons')->insert([
        [
            'course_id' => 1,
            'title' => 'Introduction to IT',
            'description' => $desc_1,
        ],
        [
            'course_id' => 1,
            'title' => 'Overview of Cloud Computing',
            'description' => $desc_2,
        ],
        [
            'course_id' => 1,
            'title' => 'What is AI? Applications and Examples of AI',
            'description' => $desc_3,
        ],
        [
            'course_id' => 1,
            'title' => 'Networking',
            'description' => $desc_4,
        ],
        [
            'course_id' => 1,
            'title' => 'Troubleshooting',
            'description' => $desc_5,
        ],
        [
            'course_id' => 2,
            'title' => 'Introduction to IT',
            'description' => $desc_1,
        ],
        [
            'course_id' => 2,
            'title' => 'Overview of Cloud Computing',
            'description' => $desc_2,
        ],
        [
            'course_id' => 2,
            'title' => 'What is AI? Applications and Examples of AI',
            'description' => $desc_3,
        ],
        [
            'course_id' => 2,
            'title' => 'Networking',
            'description' => $desc_4,
        ],
        [
            'course_id' => 2,
            'title' => 'Troubleshooting',
            'description' => $desc_5,
        ],
        [
            'course_id' => 3,
            'title' => 'Introduction to IT',
            'description' => $desc_1,
        ],
        [
            'course_id' => 3,
            'title' => 'Overview of Cloud Computing',
            'description' => $desc_2,
        ],
        [
            'course_id' => 3,
            'title' => 'What is AI? Applications and Examples of AI',
            'description' => $desc_3,
        ],
        [
            'course_id' => 3,
            'title' => 'Networking',
            'description' => $desc_4,
        ],
        [
            'course_id' => 3,
            'title' => 'Troubleshooting',
            'description' => $desc_5,
        ],
        [
            'course_id' => 4,
            'title' => 'Introduction to IT',
            'description' => $desc_1,
        ],
        [
            'course_id' => 4,
            'title' => 'Overview of Cloud Computing',
            'description' => $desc_2,
        ],
        [
            'course_id' => 4,
            'title' => 'What is AI? Applications and Examples of AI',
            'description' => $desc_3,
        ],
        [
            'course_id' => 4,
            'title' => 'Networking',
            'description' => $desc_4,
        ],
        [
            'course_id' => 4,
            'title' => 'Troubleshooting',
            'description' => $desc_5,
        ],
        [
            'course_id' => 5,
            'title' => 'Introduction to IT',
            'description' => $desc_1,
        ],
        [
            'course_id' => 5,
            'title' => 'Overview of Cloud Computing',
            'description' => $desc_2,
        ],
        [
            'course_id' => 5,
            'title' => 'What is AI? Applications and Examples of AI',
            'description' => $desc_3,
        ],
        [
            'course_id' => 5,
            'title' => 'Networking',
            'description' => $desc_4,
        ],
        [
            'course_id' => 5,
            'title' => 'Troubleshooting',
            'description' => $desc_5,
        ],
    ]);
    }
}
