<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    CourseLesson as Lesson,
    QuizQuestion as Question,
    CustomerAnswerKey as UserAnswer,
    CustomerQuizScore as UserScore,
};

class LessonQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'user_id',
        'title',
        'orders',
        'minimum_score',
    ];
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function totalQuestion()
    {
        return Question::where('quiz_id', $this->id)->count();
    }

    public function progressWork($user_id)
    {
        $minimum_score = Question::where('quiz_id', $this->id)->count();
        $user_total_answer = UserAnswer::where([['quiz_id', $this->id], ['customer_id', $user_id]])->count();

        $percent_progress = 0;
        if($minimum_score > 0) {
            $percent_progress = number_format(($user_total_answer/$minimum_score) * 100, 2);
        }

        return (float) $percent_progress;

    }

    public function userScore($user_id)
    {
        return UserScore::where([['quiz_id', $this->id], ['customer_id', $user_id]])->first();
    }
}
