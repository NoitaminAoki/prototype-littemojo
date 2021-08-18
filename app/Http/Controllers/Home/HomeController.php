<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{
    Blog,
    Course,
	Level,
    CustomerCertificate as UserCertificate,
};
use App\Helpers\StringGenerator;

class HomeController extends Controller
{
    public function index()
    {
        $popular_courses = Course::where('is_published', 1)->inRandomOrder()->offset(0)->limit(10)->get();
        $data['courses'] = (object) ['popular_courses' => $popular_courses];
    	$data['levels']    = Level::select('id', 'name')->get();
        $data['popularBlog'] = Blog::where([
            ['is_publish', true],
            ['is_highlight', true]
        ])->latest()->get();
        return view('homepage.pages.index')->with($data);
    }

    public function detailCourse($slug_course_name)
    {
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $slug_course_name)->firstOrFail();

        // dd($course);
        $data['course'] = $course;
        return view('homepage.pages.courses.detail')->with($data);
    }

    public function pdfCertificate()
    {
        $text = "ABBIULLAH AYASSY";
        $fontSize = 90;
        
        $length = (Str::length($text) > 8)? Str::length($text) - 7 : 0;
        $space_length = $length > 8? ceil($length/1.5) + 1 : $length;
        $calculate = $fontSize - ($space_length * 5);
        // dd($calculate);
        $data = ['font_size' => $calculate, 'username' => $text];
        $data['course'] = Course::find(5);
        $data['generated_hash'] = StringGenerator::hashId(11);
        // return view('homepage.pages.certificates.certificate_pdf_view')->with($data);
        $pdf = \PDF::loadview('homepage.pages.certificates.certificate_pdf',$data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function getCertificate($uuid)
    {
        $file = UserCertificate::where('uuid', $uuid)->firstOrFail();
        $path = storage_path("app/{$file->path}");
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Cache-Control' => 'no-cache, no-store, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => '0', 'Content-Type' =>'application/pdf'));
            
        }
        
        abort(404);
    }
}
