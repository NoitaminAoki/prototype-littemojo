<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    ListSequence
};

class LearningSequence extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'lesson_id',
        'title',
    ];
    
    public function items()
    {
        $items = ListSequence::select('list_sequences.id as list_id', 'list_sequences.type')
        ->selectRaw('(COALESCE(book.id, video.id, quiz.id)) as id')
        ->selectRaw('(COALESCE(book.title, video.title, quiz.title)) as title')
        ->selectRaw('CONCAT(type, "_", COALESCE(book.id, video.id, quiz.id)) as unique_id')
        ->leftJoin('lesson_books as book', 'list_sequences.book_id', '=', 'book.id')
        ->leftJoin('lesson_videos as video', 'list_sequences.video_id', '=', 'video.id')
        ->leftJoin('lesson_quizzes as quiz', 'list_sequences.quiz_id', '=', 'quiz.id')
        ->where('sequence_id', $this->id)
        ->orderBy('order', 'asc')
        ->get();
        return $items;
    }
}
