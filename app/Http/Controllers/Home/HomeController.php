<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Course,
};

class HomeController extends Controller
{
    public function index()
    {
        $popular_courses = Course::inRandomOrder()->offset(1)->limit(10)->get();
        $data['courses'] = (object) ['popular_courses' => $popular_courses];
        // dd($data);
        return view('homepage.pages.index')->with($data);
    }
}
