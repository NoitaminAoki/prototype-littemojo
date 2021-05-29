<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Course,
    LessonBook as Book,
    LessonVideo as Video,
    LessonQuiz as Quiz,
    CustomerCourseProgress as UserCourseProgress,
    CustomerLessonProgress as UserLessonProgress,
};
use DB;

class CourseLesson extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->hasMany(Book::class, 'lesson_id')->orderBy('orders', 'asc');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'lesson_id')->orderBy('orders', 'asc');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'lesson_id')->orderBy('orders', 'asc');
    }

    public function totalBooks()
    {
        return Book::where('lesson_id', $this->id)->count();
    }

    public function totalVideos()
    {
        return Video::select(\DB::raw('COUNT(id) as total, IFNULL(SUM(duration), 0) as duration, IFNULL(FLOOR(SUM((duration/60))), 0) as duration_as_minute'))->where('lesson_id', $this->id)
        // ->groupBy('id')
        ->first();
    }

    public function totalQuizzes()
    {
        return Quiz::where('lesson_id', $this->id)->count();
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getTotalItems()
    {
        $lesson = DB::table('course_lessons as cl')
        ->select('cl.id')
        ->selectRaw('COUNT(DISTINCT lv.id) as total_videos, COUNT(DISTINCT lb.id) as total_books, COUNT(DISTINCT lq.id) as total_quizzes')
        ->leftJoin('lesson_videos as lv', 'lv.lesson_id', '=', 'cl.id')
        ->leftJoin('lesson_books as lb', 'lb.lesson_id', '=', 'cl.id')
        ->leftJoin('lesson_quizzes as lq', 'lq.lesson_id', '=', 'cl.id')
        ->groupBy('cl.id')
        ->where('cl.id', $this->id)
        ->first();

        $total_items = ($lesson->total_videos + $lesson->total_books + $lesson->total_quizzes);
        $data['total_videos'] = $lesson->total_videos;
        $data['total_books'] = $lesson->total_books;
        $data['total_quizzes'] = $lesson->total_quizzes;
        $data['total'] = $total_items;

        return (object)$data;
    }

    public function getTotalProgress($user_id)
    {
        // COUNT(DISTINCT lv.id) as total_videos, COUNT(DISTINCT lb.id) as total_books, COUNT(DISTINCT lq.id) as total_quizzes
        $lesson = DB::table('course_lessons as cl')
        ->select('cl.id')
        ->selectRaw('COUNT(DISTINCT lv.id) as total_videos, COUNT(DISTINCT lb.id) as total_books, COUNT(DISTINCT lq.id) as total_quizzes')
        ->leftJoin('lesson_videos as lv', 'lv.lesson_id', '=', 'cl.id')
        ->leftJoin('lesson_books as lb', 'lb.lesson_id', '=', 'cl.id')
        ->leftJoin('lesson_quizzes as lq', 'lq.lesson_id', '=', 'cl.id')
        ->groupBy('cl.id')
        ->where('cl.id', $this->id)
        ->first();

        $inprogress_lesson = CustomerLessonProgress::where(['customer_id' => $user_id, 'course_id' => $this->course_id, 'lesson_id' => $this->id])->count();

        $total_items = ($lesson->total_videos + $lesson->total_books + $lesson->total_quizzes);
        $data['inprogress'] = $inprogress_lesson;
        $data['total'] = $total_items;

        return (object)$data;
    }

    public function isFinished($user_id)
    {
        $progress = UserCourseProgress::where(['customer_id' => $user_id, 'course_id' => $this->course_id, 'lesson_id' => $this->id])->first();
        if($progress) {
            return true;
        }
        return false;
    }
}
