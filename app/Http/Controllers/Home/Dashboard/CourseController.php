<?php

namespace App\Http\Controllers\Home\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Course,
};

class CourseController extends Controller
{
    public function course($slug_course_name)
    {
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $slug_course_name)->firstOrFail();
        
        // dd($course);
        $data['course'] = $course;
        return view('homepage.pages.courses.enrolled.course')->with($data);
    }
}
