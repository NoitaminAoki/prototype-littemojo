<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    QuestionOption as Option,
};

class QuizAnswerKey extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quiz_id',
        'question_id',
        'option_id',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }
}
