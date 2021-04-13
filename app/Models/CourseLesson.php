<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Course,
    LessonBook as Book,
    LessonVideo as Video,
    LessonQuiz as Quiz,
};

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
}
