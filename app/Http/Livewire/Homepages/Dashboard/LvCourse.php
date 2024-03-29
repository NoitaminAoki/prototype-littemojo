<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Course,
    CourseLesson,
    CustomerCourseProgress as UserCourseProgress,
};

class LvCourse extends Component
{
    public $slug_course_name;
    
    public $selected_lesson;
    
    public function mount($title)
    {
        $user_auth = Auth::guard('web')->user();
        $this->slug_course_name  = $title;
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();

        $get_completed_lesson = UserCourseProgress::where(['customer_id' => $user_auth->id, 'course_id' => $course->id])
        ->orderBy('lesson_id', 'desc')
        ->first();

        if($get_completed_lesson) {
            $get_lesson = CourseLesson::where('course_id', $course->id)
            ->where('id', '>', $get_completed_lesson->lesson_id)->orderBy('id', 'asc')->first();

            if($get_lesson) {
                return $this->selected_lesson = $get_lesson;
            }
        }
        
        $this->selected_lesson = CourseLesson::where('course_id', $course->id)->orderBy('id', 'asc')->first();
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

    public function setLesson($id)
    {
        $this->selected_lesson = CourseLesson::where('id', $id)->firstOrFail();
    }
}
