<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    LessonQuiz as Quiz,
    QuestionOption as Option,
    QuizAnswerKey as AnswerKey,
};

class QuizQuestion extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quiz_id',
        'uuid',
        'image',
        'path',
        'title',
        'orders',
    ];
    
    public function options()
    {
        return $this->hasMany(Option::class, 'question_id')->orderBy('orders', 'asc');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function answerKey()
    {
        return $this->belongsTo(AnswerKey::class, 'id', 'question_id');
    }

    public function lastOrder()
    {
        $last_question = $this->orderBy('orders', 'DESC')->first();

        if($last_question) {
            return $last_question->orders;
        }
        return 1;
    }

}
