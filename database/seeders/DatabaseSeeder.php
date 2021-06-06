<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PartnerSeeder::class,
            CatalogSeeder::class,
            LevelSeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            ExperienceSeeder::class,
            SkillSeeder::class,
            CorporationSeeder::class,
            CustomerTransactionSeeder::class,
            PartnerFundTransactionSeeder::class,
            PartnerWalletSeeder::class,
            BlogSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
