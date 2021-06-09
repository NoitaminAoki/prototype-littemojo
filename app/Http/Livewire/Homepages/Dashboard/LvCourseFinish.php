<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Course,
    CourseLesson,
    CustomerCourseProgress as UserCourseProgress,
};

class LvCourseFinish extends Component
{
    public $slug_course_name;
    public $selected_lesson;
    public $is_course_finished = false;

    public function mount($title)
    {
        $user_auth = Auth::guard('web')->user();
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $title)->firstOrFail();

        if (!$course->isPurchased($user_auth->id)) {
            return redirect()->route('home.detail.course', ['title' => $title]);
        }

        $this->slug_course_name  = $title;

        $get_completed_lesson = UserCourseProgress::where(['customer_id' => $user_auth->id, 'course_id' => $course->id])
        ->orderBy('lesson_id', 'desc')
        ->first();

        // dd($get_completed_lesson);

        if($get_completed_lesson) {
            $get_lesson = CourseLesson::where('course_id', $course->id)
            ->where('id', '>', $get_completed_lesson->lesson_id)->orderBy('id', 'asc')->first();

            if($get_lesson) {
                return $this->selected_lesson = $get_lesson;
            }

            else {
                return $this->selected_lesson = CourseLesson::where(['course_id' => $course->id, 'id' => $get_completed_lesson->lesson_id])->first();
            }
        }
        
        $this->selected_lesson = CourseLesson::where('course_id', $course->id)->orderBy('id', 'asc')->first();
    }
    
    public function render()
    {
        $user_auth = Auth::guard('web')->user();
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();
        $this->is_course_finished = $course->isFinished($user_auth->id);
        $data['course'] = $course;

        return view('homepage.pages.courses.enrolled.lv_course_finish')
        ->with($data)
        ->layout('homepage.dashboard_layouts.lv_main');
    }
}
