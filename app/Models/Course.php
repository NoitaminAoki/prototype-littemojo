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
    Corporation
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
}
