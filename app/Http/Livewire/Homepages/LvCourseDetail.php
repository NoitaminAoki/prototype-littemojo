<?php

namespace App\Http\Livewire\Homepages;

use Livewire\Component;
use App\Models\{
    Course,
    CustomerCourseRating as UserCourseRating,
};

class LvCourseDetail extends Component
{
    public $slug_course_name;

    public function mount($title)
    {
        $this->slug_course_name  = $title;
    }

    public function render()
    {
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();



        $data['course'] = $course;
        $data['courseReviews'] = UserCourseRating::where('course_id', $course->id)->orderBy('rating', 'desc')->limit(5)->get();
        $data['courseDetailRating'] = $course->getDetailRating();
        // dd($data);
        
        return view('homepage.pages.courses.lv_detail')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }
}
