<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Course,
    CourseLesson,
    CustomerLessonRating as UserLessonRating,
    CustomerCourseProgress as UserCourseProgress,
};

class LvLessonRating extends Component
{
    protected $listeners = ['redirectToCourse' => 'finishCourse'];

    public $slug_course_name;
    
    public $lesson;
    public $lesson_url;
    
    public $course_id;
    public $lesson_id;
    public $user_rating_id;

    public $rating_value = 5;
    public $rating_desc = '';

    public function mount($title, $lesson_id)
    {
        $user_auth = Auth::guard('web')->user();
        $this->slug_course_name  = $title;
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();
        $this->course_id = $course->id;
        $this->lesson_id = $lesson_id;

        $user_rating = UserLessonRating::firstOrCreate(
            ['customer_id' => $user_auth->id, 'course_id' => $course->id, 'lesson_id' => $lesson_id],
            ['rating' => 5]
        );

        $course_progress = UserCourseProgress::firstOrCreate(
            ['customer_id' => $user_auth->id, 'course_id' => $course->id, 'lesson_id' => $lesson_id],
            ['is_finished' => 1]
        );

        $this->user_rating_id = $user_rating->id;
        $this->rating_value = $user_rating->rating;
        $this->rating_desc = $user_rating->description;

        if ($course->isFinished($user_auth->id)) {
            $this->lesson_url = route('home.dashboard.course', ['title' => $title]);
        } else {
            $this->lesson_url = route('home.dashboard.course.lesson', ['title' => $title]);
        }

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
        $this->lesson = CourseLesson::where([['course_id', $this->course_id], ['id', $this->lesson_id]])->first();

        return view('homepage.pages.courses.enrolled.lv_lesson_rating')
        ->with($data)
        ->layout('homepage.dashboard_layouts.lv_main');
    }

    public function submitRating()
    {
        $user_auth = Auth::guard('web')->user();
        if($this->rating_value < 1 || $this->rating_value > 5) {
            $this->rating_value = 5;
        }
        $user_rating = UserLessonRating::where(['customer_id' => $user_auth->id, 'course_id' => $this->course_id, 'lesson_id' => $this->lesson_id])
        ->update(['rating' => $this->rating_value, 'description' => $this->rating_desc]);
        
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => "Thank You for Your Feedback."]);
    }

    public function finishCourse()
    {
        session()->flash('notification', 'You have been finished the course!');
        return redirect()->route('home.dashboard.course', ['title' => $this->slug_course_name]);
    }
}
