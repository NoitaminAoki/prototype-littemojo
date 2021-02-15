<?php

namespace App\Http\Controllers\Partners\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseLesson as Lesson;

class LessonController extends Controller
{
    public function show(Lesson $lesson)
    {
        return view('partners.course.lesson.show')->with(compact('lesson'));
    }
}
