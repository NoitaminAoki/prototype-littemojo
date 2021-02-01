<?php

namespace App\Http\Controllers\Partners\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    GainedExperience as Experiences,
	Course,
};

class ExperienceController extends Controller
{
    public function index($course_id)
    {
    	$data['course'] = Course::select('courses.id', 'courses.catalog_id', 'courses.catalog_topic_id', 'title', 'description', 'price', 'catalog_topics.name as nama_catalog_topic',
        						'catalogs.name as nama_catalog')
    						 ->join('catalog_topics', 'catalog_topics.id', 'courses.id')
    						 ->join('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
        					 ->findOrFail($course_id);
        $data['experiences'] = Experiences::where('course_id', $course_id)->get();
        return view('partners.course.experience.index')->with($data);
    }
}
