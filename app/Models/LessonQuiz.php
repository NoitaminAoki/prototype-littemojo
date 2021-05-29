<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    CourseLesson as Lesson,
    QuizQuestion as Question,
    CustomerAnswerKey as UserAnswer,
    CustomerQuizScore as UserScore,
    CustomerQuizRating as UserQuizRating,
    CustomerLessonProgress as UserProgress,
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
        return UserScore::select('customer_quiz_scores.*', \DB::raw('IF(customer_quiz_scores.score >= quiz.minimum_score, true, false) as is_pass'))
        ->leftJoin('lesson_quizzes as quiz', 'quiz.id', 'customer_quiz_scores.quiz_id')
        ->where([['customer_quiz_scores.quiz_id', $this->id], ['customer_quiz_scores.customer_id', $user_id]])
        ->first();
    }

    public function isLiked($user_id)
    {
        $rate = UserQuizRating::where([['customer_id', $user_id], ['lesson_id', $this->lesson_id], ['quiz_id', $this->id]])->first();
        if ($rate && $rate->like == 1) {
            return true;
        }
        return false;
    }
    public function isDisliked($user_id)
    {
        $rate = UserQuizRating::where([['customer_id', $user_id], ['lesson_id', $this->lesson_id], ['quiz_id', $this->id]])->first();
        if ($rate && $rate->dislike == 1) {
            return true;
        }
        return false;
    }

    public function isFinished($user_id)
    {
        $progress = UserProgress::where(['customer_id' => $user_id, 'lesson_id' => $this->lesson_id, 'quiz_id' => $this->id, 'type' => 'quiz'])->first();
        if($progress) {
            return true;
        }
        return false;
    }
}
