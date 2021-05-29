<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    CourseLesson as Lesson,
    CustomerVideoRating as UserVideoRating,
    CustomerLessonProgress as UserProgress,
};

class LessonVideo extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lesson_id',
        'user_id',
        'uuid',
        'title',
        'orders',
        'filename',
        'duration',
        'size',
    ];
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function isLiked($user_id)
    {
        $rate = UserVideoRating::where([['customer_id', $user_id], ['lesson_id', $this->lesson_id], ['video_id', $this->id]])->first();
        if ($rate && $rate->like == 1) {
            return true;
        }
        return false;
    }

    public function isDisliked($user_id)
    {
        $rate = UserVideoRating::where([['customer_id', $user_id], ['lesson_id', $this->lesson_id], ['video_id', $this->id]])->first();
        if ($rate && $rate->dislike == 1) {
            return true;
        }
        return false;
    }
    
    public function isFinished($user_id)
    {
        $progress = UserProgress::where(['customer_id' => $user_id, 'lesson_id' => $this->lesson_id, 'video_id' => $this->id, 'type' => 'video'])->first();
        if($progress) {
            return true;
        }
        return false;
    }
}
