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
use DB;
use DateTime;
use DateTimeZone;

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
        ->orderBy('ct.start_date', 'desc')
        ->get();

        $data['inprogress_courses'] = $this->getInprogressCourse($user_auth->id);
        $data['completed_courses'] = $this->getCompletedCourse($user_auth->id);
        $data['purchased_courses'] = $courses;

        // dd($data);
        return view('homepage.pages.dashboard.dashboard_index')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }

    public function getInprogressCourse($user_id)
    {
        $date_now = date_format(new DateTime("now", new DateTimeZone('Asia/Jakarta')), 'Y-m-d H:i:s');
        $course = Course::select('courses.id', 'courses.user_id', 'courses.title', 'courses.slug_title', 'courses.catalog_id', 'courses.duration')
        ->selectRaw('COUNT(DISTINCT cl.id) as total_lesson, COUNT(DISTINCT ccp.id) as lesson_progress')
        ->leftJoin('course_lessons as cl', 'cl.course_id', '=', 'courses.id')
        ->leftJoin('customer_course_progress as ccp', function($join) use($user_id) {
            $join->on('ccp.course_id', '=', 'courses.id')
            ->where('ccp.customer_id', '=', $user_id);
        })
        ->rightJoin('customer_transactions as ct', 'ct.course_id', '=', 'courses.id')
        ->groupBy('courses.id', 'courses.user_id', 'courses.title', 'courses.slug_title', 'courses.catalog_id', 'courses.duration')
        ->havingRaw('lesson_progress < total_lesson')
        ->where(['ct.customer_id' => $user_id, 'ct.status_payment' => 'settlement'])
        ->where('ct.start_date', '<=', $date_now)
        ->where(DB::raw('ADDDATE(ct.start_date, INTERVAL (IF(courses.duration = "week", 7, 30)) DAY)'), '>=', $date_now)
        ->orderBy('lesson_progress')
        ->get();

        return $course;
    }

    public function getCompletedCourse($user_id)
    {
        $course = Course::select('courses.id', 'courses.user_id', 'courses.title', 'courses.slug_title', 'courses.catalog_id')
        ->selectRaw('COUNT(DISTINCT cl.id) as total_lesson, COUNT(DISTINCT ccp.id) as lesson_progress')
        ->leftJoin('course_lessons as cl', 'cl.course_id', '=', 'courses.id')
        ->leftJoin('customer_course_progress as ccp', function($join) use($user_id) {
            $join->on('ccp.course_id', '=', 'courses.id')
            ->where('ccp.customer_id', '=', $user_id);
        })
        ->rightJoin('customer_transactions as ct', 'ct.course_id', '=', 'courses.id')
        ->groupBy('courses.id', 'courses.user_id', 'courses.title', 'courses.slug_title', 'courses.catalog_id')
        ->havingRaw('lesson_progress >= total_lesson')
        ->where(['ct.customer_id' => $user_id, 'ct.status_payment' => 'settlement'])
        ->orderBy('ct.start_date', 'desc')
        ->get();

        return $course;
    }
}
