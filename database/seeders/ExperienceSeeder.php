<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gained_experiences')->insert([
            [
                'course_id' => 1,
                'name' => 'Gain skills required to succeed in an entry-level IT job',
            ],
            [
                'course_id' => 1,
                'name' => 'Learn how to provide end-to-end customer support, ranging from identifying problems to troubleshooting and debugging',
            ],
            [
                'course_id' => 1,
                'name' => 'Learn to perform day-to-day IT support tasks including computer assembly, wireless networking, installing programs, and customer service',
            ],
            [
                'course_id' => 1,
                'name' => 'Learn to use systems including Linux, Domain Name Systems, Command-Line Interface, and Binary Code',
            ],
            [
                'course_id' => 1,
                'name' => 'Understand key technologies driving modern businesses and have meaningful conversations around Cloud, Data and AI, and related buzzwords',
            ],
            [
                'course_id' => 2,
                'name' => 'Gain skills required to succeed in an entry-level IT job',
            ],
            [
                'course_id' => 2,
                'name' => 'Learn how to provide end-to-end customer support, ranging from identifying problems to troubleshooting and debugging',
            ],
            [
                'course_id' => 2,
                'name' => 'Learn to perform day-to-day IT support tasks including computer assembly, wireless networking, installing programs, and customer service',
            ],
            [
                'course_id' => 2,
                'name' => 'Learn to use systems including Linux, Domain Name Systems, Command-Line Interface, and Binary Code',
            ],
            [
                'course_id' => 2,
                'name' => 'Understand key technologies driving modern businesses and have meaningful conversations around Cloud, Data and AI, and related buzzwords',
            ],
            [
                'course_id' => 3,
                'name' => 'Gain skills required to succeed in an entry-level IT job',
            ],
            [
                'course_id' => 3,
                'name' => 'Learn how to provide end-to-end customer support, ranging from identifying problems to troubleshooting and debugging',
            ],
            [
                'course_id' => 3,
                'name' => 'Learn to perform day-to-day IT support tasks including computer assembly, wireless networking, installing programs, and customer service',
            ],
            [
                'course_id' => 3,
                'name' => 'Learn to use systems including Linux, Domain Name Systems, Command-Line Interface, and Binary Code',
            ],
            [
                'course_id' => 3,
                'name' => 'Understand key technologies driving modern businesses and have meaningful conversations around Cloud, Data and AI, and related buzzwords',
            ],
            [
                'course_id' => 4,
                'name' => 'Gain skills required to succeed in an entry-level IT job',
            ],
            [
                'course_id' => 4,
                'name' => 'Learn how to provide end-to-end customer support, ranging from identifying problems to troubleshooting and debugging',
            ],
            [
                'course_id' => 4,
                'name' => 'Learn to perform day-to-day IT support tasks including computer assembly, wireless networking, installing programs, and customer service',
            ],
            [
                'course_id' => 4,
                'name' => 'Learn to use systems including Linux, Domain Name Systems, Command-Line Interface, and Binary Code',
            ],
            [
                'course_id' => 4,
                'name' => 'Understand key technologies driving modern businesses and have meaningful conversations around Cloud, Data and AI, and related buzzwords',
            ],
            [
                'course_id' => 5,
                'name' => 'Gain skills required to succeed in an entry-level IT job',
            ],
            [
                'course_id' => 5,
                'name' => 'Learn how to provide end-to-end customer support, ranging from identifying problems to troubleshooting and debugging',
            ],
            [
                'course_id' => 5,
                'name' => 'Learn to perform day-to-day IT support tasks including computer assembly, wireless networking, installing programs, and customer service',
            ],
            [
                'course_id' => 5,
                'name' => 'Learn to use systems including Linux, Domain Name Systems, Command-Line Interface, and Binary Code',
            ],
            [
                'course_id' => 5,
                'name' => 'Understand key technologies driving modern businesses and have meaningful conversations around Cloud, Data and AI, and related buzzwords',
            ],
        ]);
    }
}
