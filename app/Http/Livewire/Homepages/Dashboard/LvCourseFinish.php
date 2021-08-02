<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\StringGenerator;
use App\Models\{
    Course,
    CourseLesson,
    CustomerCourseProgress as UserCourseProgress,
    CustomerCertificate as UserCertificate,
};

class LvCourseFinish extends Component
{
    public $slug_course_name;
    public $selected_lesson;
    public $is_course_finished = false;

    public $course_id;
    public $user_certificate;

    public function mount($title)
    {
        $user_auth = Auth::guard('web')->user();
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $title)->firstOrFail();

        $this->course_id = $course->id;

        $course_status = $course->getAccess($user_auth->id);
        if($course_status->status_number == 3 || $course_status->status_number == 0) {
            abort(404);
        }

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
        $this->user_certificate = $course->getCustomerCertificate($user_auth->id);
        $data['course'] = $course;

        return view('homepage.pages.courses.enrolled.lv_course_finish')
        ->with($data)
        ->layout('homepage.dashboard_layouts.lv_main');
    }

    public function generateCertificate()
    {
        $user_auth = Auth::guard('web')->user();
        $certificate = UserCertificate::where(['customer_id' => $user_auth->id, 'course_id' => $this->course_id])->first();
        if(!$certificate) {
            $data['course'] = Course::find($this->course_id);
            $data['generated_hash'] = StringGenerator::hashId(11);
            $text = $user_auth->name;
            $fontSize = 90;
            
            $length = (Str::length($text) > 8)? Str::length($text) - 7 : 0;
            $space_length = $length > 8? ceil($length/1.5) + 1 : $length;
            $data['font_size'] = $fontSize - ($space_length * 5);
            $data['username'] = $text;
            $pdf = \PDF::loadview('homepage.pages.certificates.certificate_pdf', $data);
            $pdf->setPaper('A4', 'landscape');
            // dd($pdf->stream());
            $content = $pdf->download()->getOriginalContent();
    
            $slug_username = Str::slug($user_auth->name);
            $uri = "/certificates/user_{$user_auth->id}/{$slug_username}_{$this->slug_course_name}.pdf";
            Storage::put($uri, $content);
            
            $certificate = UserCertificate::create([
                'customer_id' => $user_auth->id,
                'course_id' => $this->course_id,
                'uuid' => Str::uuid(),
                'hash_id' => $data['generated_hash'],
                'filename' => "{$slug_username}_{$this->slug_course_name}.pdf",
                'path' => $uri,
            ]);
            return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => "Your certificate has successfully created!"]);
            // dd($certificate);
        }
        // dd($certificate);
        // dd($content);
    }
}
