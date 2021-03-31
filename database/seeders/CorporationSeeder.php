<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorporationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('corporations')->insert([
            'partner_id' => 2,
            'uuid' => "88224769-702a-309b-5682-4e61vf3095t4",
            'name' => "Google",
            'image' => "_image.png",
            'logo' => "_logo.png",
            'thumbnail' => "_thumbnail.png",
            'path' => "uploaded_files/corporation/88224769-702a-309b-5682-4e61vf3095t4/_image.png",
            'path_logo' => "uploaded_files/corporation/88224769-702a-309b-5682-4e61vf3095t4/_logo.png",
            'path_thumbnail' => "uploaded_files/corporation/88224769-702a-309b-5682-4e61vf3095t4/_thumbnail.png",
            'description' => "Google Career Certificates are part of Grow with Google, an initiative that draws on Google's 20-year history of building products, platforms, and services that help people and businesses grow. Through programs like these, we aim to help everyone– those who make up the workforce of today and the students who will drive the workforce of tomorrow – access the best of Google’s training and tools to grow their skills, careers, and businesses.",
        ]);
    }
}
