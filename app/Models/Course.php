<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    GainedExperience as Experiences,
    CourseSkill as Skills,
    CourseLesson as Lesson,
    Catalog,
    Partner,
    Corporation,
    CustomerCourseProgress as UserCourseProgress,
};

class Course extends Model
{
    use HasFactory;
    protected $guarded  = [];
    
    public function corporation()
    {
        return $this->hasOneThrough(
            Corporation::class,
            Partner::class,
            'id',
            'partner_id',
            'user_id',
            'id'
        );
    }

    public function experiences()
    {
        return $this->hasMany(Experiences::class, 'course_id');
    }
    
    public function skills()
    {
        return $this->hasMany(Skills::class, 'course_id');
    }
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function catalog(Type $var = null)
    {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }

    public function isFinished($user_id)
    {
        $lesson = Lesson::selectRaw('COUNT(course_lessons.id) as total_lesson, COUNT(ccp.id) as completed_lesson')
        ->leftJoin('customer_course_progress as ccp', function($join) use($user_id) {
            $join->on('ccp.course_id', '=', 'course_lessons.course_id')
            ->on('ccp.lesson_id', '=', 'course_lessons.id')
            ->where('ccp.customer_id', '=', $user_id);
        })
        ->where('course_lessons.course_id', $this->id)
        ->first();
        
        if($lesson) {
            if($lesson->total_lesson == $lesson->completed_lesson) {
                return true;
            }
        }
        return false;
    }
}
