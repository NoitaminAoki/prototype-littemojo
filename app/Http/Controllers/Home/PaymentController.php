<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Course,
};

class PaymentController extends Controller
{
    public function index($slug_course_name)
    {
        
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $slug_course_name)
        ->firstOrFail();
        
        $popular_courses = Course::where([['is_published', '=', 1], ['user_id', '=', $course->user_id]])->inRandomOrder()->offset(0)->limit(10)->get();
        
        $data['course'] = $course;
        $data['courses'] = (object) ['popular_courses' => $popular_courses];
        // dd($data);
        return view('homepage.pages.payments.pay_course')->with($data);
    }
    
    public function pay()
    {
        
    }
}
