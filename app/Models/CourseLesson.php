<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Course,
    LessonBook as Books,
    LessonVideo as Videos,
    LessonQuiz as Quizzes,
};

class CourseLesson extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->hasMany(books::class, 'lesson_id')->orderBy('orders', 'asc');
    }

    public function videos()
    {
        return $this->hasMany(Videos::class, 'lesson_id')->orderBy('orders', 'asc');
    }

    public function quizzes()
    {
        return $this->hasMany(Quizzes::class, 'lesson_id')->orderBy('orders', 'asc');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
