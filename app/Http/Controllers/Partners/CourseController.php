<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $data['courses'] = Course::orderBy('id', 'DESC')->get();
        return view('partners.course.index')->with($data);
    }
}
