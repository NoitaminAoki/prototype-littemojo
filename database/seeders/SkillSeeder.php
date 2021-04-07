<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obtain_skills')->insert([
            [
                'catalog_id' => '4',
                'name' => 'Cloud Computing',
            ],
            [
                'catalog_id' => '4',
                'name' => 'Machine Learning',
            ],
            [
                'catalog_id' => '4',
                'name' => 'Technology',
            ],
            [
                'catalog_id' => '4',
                'name' => 'Artificial Intelligence (AI)',
            ],
            [
                'catalog_id' => '4',
                'name' => 'Algorithm',
            ],
        ]);

        DB::table('course_skills')->insert([
            [
                'course_id' => 1,
                'skill_id' => 1,
            ],
            [
                'course_id' => 1,
                'skill_id' => 2,
            ],
            [
                'course_id' => 1,
                'skill_id' => 3,
            ],
            [
                'course_id' => 1,
                'skill_id' => 4,
            ],
            [
                'course_id' => 1,
                'skill_id' => 5,
            ],
            [
                'course_id' => 2,
                'skill_id' => 1,
            ],
            [
                'course_id' => 2,
                'skill_id' => 2,
            ],
            [
                'course_id' => 2,
                'skill_id' => 3,
            ],
            [
                'course_id' => 2,
                'skill_id' => 4,
            ],
            [
                'course_id' => 2,
                'skill_id' => 5,
            ],
            [
                'course_id' => 3,
                'skill_id' => 1,
            ],
            [
                'course_id' => 3,
                'skill_id' => 2,
            ],
            [
                'course_id' => 3,
                'skill_id' => 3,
            ],
            [
                'course_id' => 3,
                'skill_id' => 4,
            ],
            [
                'course_id' => 3,
                'skill_id' => 5,
            ],
            [
                'course_id' => 4,
                'skill_id' => 1,
            ],
            [
                'course_id' => 4,
                'skill_id' => 2,
            ],
            [
                'course_id' => 4,
                'skill_id' => 3,
            ],
            [
                'course_id' => 4,
                'skill_id' => 4,
            ],
            [
                'course_id' => 4,
                'skill_id' => 5,
            ],
            [
                'course_id' => 5,
                'skill_id' => 1,
            ],
            [
                'course_id' => 5,
                'skill_id' => 2,
            ],
            [
                'course_id' => 5,
                'skill_id' => 3,
            ],
            [
                'course_id' => 5,
                'skill_id' => 4,
            ],
            [
                'course_id' => 5,
                'skill_id' => 5,
            ],
        ]);
    }
}
