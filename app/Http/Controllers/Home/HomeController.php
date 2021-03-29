<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Course,
};

class HomeController extends Controller
{
    public function index()
    {
        $popular_courses = Course::where('is_published', 1)->inRandomOrder()->offset(0)->limit(10)->get();
        $data['courses'] = (object) ['popular_courses' => $popular_courses];
        // dd($data);
        return view('homepage.pages.index')->with($data);
    }

    public function detailCourse($slug_course_name)
    {
        $normal_course_name = str_replace('-', ' ', $slug_course_name);
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('title', $normal_course_name)->first();

        if(is_null($course)) {
            abort(404);
        }
        // dd($course);
        $data['course'] = $course;
        return view('homepage.pages.courses.detail')->with($data);
    }
}
