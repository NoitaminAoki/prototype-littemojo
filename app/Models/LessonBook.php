<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    CourseLesson as Lesson,
};

class LessonBook extends Model
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
        'size',
    ];
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
