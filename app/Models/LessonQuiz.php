<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    CourseLesson as Lesson,
};

class LessonQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'user_id',
        'title',
        'orders',
        'total_question',
    ];
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
