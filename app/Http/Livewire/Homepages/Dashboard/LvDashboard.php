<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Course,
    CourseLesson,
    CustomerTransaction as UserTransaction,
    CustomerCourseProgress as UserCourseProgress,
};

class LvDashboard extends Component
{
    public $user_id;
    public function render()
    {
        $user_auth = Auth::guard('web')->user();
        $this->user_id = $user_auth->id;
        $courses = Course::select('courses.*', 'ct.status_payment')
        ->rightJoin('customer_transactions as ct', 'ct.course_id', '=', 'courses.id')
        ->where(['ct.customer_id' => $user_auth->id, 'ct.status_payment' => 'settlement'])
        ->get();

        $data['purchased_courses'] = $courses;

        return view('homepage.pages.dashboard.dashboard_index')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }
}
