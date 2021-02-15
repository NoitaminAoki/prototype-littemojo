<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    LessonBook as Books,
};

class CourseLesson extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->hasMany(books::class, 'lesson_id');
    }
}
