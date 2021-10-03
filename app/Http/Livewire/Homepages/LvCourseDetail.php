<?php

namespace App\Http\Livewire\Homepages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Course,
    CustomerCourseRating as UserCourseRating,
};

class LvCourseDetail extends Component
{
    public $slug_course_name;

    public $course_id;
    public $form_is_edit_review;
    public $rating_value = 5;
    public $rating_desc = '';

    public function mount($title)
    {
        $this->slug_course_name  = $title;
        $this->form_is_edit_review = false;
    }

    public function render()
    {
        $user_auth = Auth::guard('web')->user();
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();

        $this->course_id = $course->id;



        $data['course'] = $course;
        $data['course_is_purchased'] = false;
        $data['user_course_review'] = null;
        $data['courseReviews'] = UserCourseRating::where('course_id', $course->id)->orderBy('rating', 'desc')->limit(5)->get();
        $data['courseDetailRating'] = $course->getDetailRating();
        
        if($user_auth) {
            $data['course_is_purchased'] = $course->isPurchased($user_auth->id);
            $data['user_course_review'] = UserCourseRating::where(['course_id' => $course->id, 'customer_id' => $user_auth->id])->first();
            if($data['user_course_review']) {
                $this->rating_value = $data['user_course_review']->rating;
                $this->rating_desc = $data['user_course_review']->description;
            }
        }
        $data['total_reviews'] = UserCourseRating::where('course_id', $course->id)->count();
        // dd($data);
        return view('homepage.pages.courses.lv_detail')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }

    public function editReview()
    {
        $this->form_is_edit_review = true;
    }

    public function submitReview()
    {
        $user_auth = Auth::guard('web')->user();
        if($this->rating_value < 1 || $this->rating_value > 5) {
            $this->rating_value = 5;
        }
        $user_rating = UserCourseRating::updateOrCreate(
            ['customer_id' => $user_auth->id, 'course_id' => $this->course_id],
            ['rating' => $this->rating_value, 'description' => $this->rating_desc]
        );
        $this->form_is_edit_review = false;
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => "Thank You for Your Feedback."]);
    }
}
