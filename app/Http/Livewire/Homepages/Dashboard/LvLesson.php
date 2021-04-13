<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;
use App\Models\{
    Course,
    CourseLesson,
};

class LvLesson extends Component
{
    public $slug_course_name;
    
    public $lesson;

    public function mount($title, $lesson_id)
    {
        $this->slug_course_name  = $title;
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();
        $this->lesson = CourseLesson::where([['course_id', $course->id], ['lesson_id', $lesson_id]])->first();
    }
    public function render()
    {
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();
        
        // dd($course);
        $data['course'] = $course;


        return view('homepage.pages.courses.enrolled.lv_course')
        ->with($data)
        ->layout('homepage.dashboard_layouts.lv_main');
    }
}
