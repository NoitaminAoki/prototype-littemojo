<?php

namespace App\Http\Controllers\Admins\Manage\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Course, Catalog, CourseLesson, LessonBook, LessonQuiz, QuizQuestion
};

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['courses'] = Course::select('courses.id', 'courses.title', 'courses.description', 'price', 'duration', 'courses.is_verified', 'courses.date_verified', 'catalog_topics.name as nama_catalog_topic', 'catalogs.name as nama_catalog', 'levels.name as nama_level')
                             ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.id')
                             ->leftJoin('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
                             ->leftJoin('levels', 'levels.id', 'courses.level_id')
                             ->orderBy('courses.is_verified', 'ASC')->get();
        return view('admins/manage/partner/verif_course.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catalogs = Catalog::all();
        $course   = Course::select('courses.id', 'courses.catalog_id', 'courses.uuid', 'courses.cover', 'courses.catalog_topic_id', 'courses.title', 'courses.description', 'courses.price', 'courses.duration',
                            'catalog_topics.name as nama_catalog_topic',
                            'catalogs.name as nama_catalog',
                            'levels.name as nama_level', 'levels.description as desc_level')
                            ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.id')
                            ->leftJoin('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
                            ->leftJoin('levels', 'levels.id', 'courses.level_id')
                            ->findOrFail($id);
        return view('admins/manage/partner/verif_course.show', compact('catalogs', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $upd = Course::findOrFail($id);
        $upd->is_verified = true;
        $upd->date_verified = date('Y-m-d H:i:s');
        $upd->save();
        return redirect('admin/management/partner/verif_course')->with('alert-message', 'Berhasil Memverifikasi Data Course');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function lesson($id){
        $data = Course::select('courses.id', 'courses.catalog_id', 'courses.catalog_topic_id', 'title', 'description', 'price', 'catalog_topics.name as nama_catalog_topic',
            'catalogs.name as nama_catalog')
        ->join('catalog_topics', 'catalog_topics.id', 'courses.id')
        ->join('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
        ->findOrFail($id);

        $lessons = CourseLesson::where('course_id', $id)->get();

        return view('admins/manage/partner/verif_course.lesson.index')
        ->with(['course' => $data, 'lessons' => $lessons]);
    }

    public function detailLesson(CourseLesson $lesson){
        return view('admins/manage/partner/verif_course/lesson.show')->with(compact('lesson'));
    }

    public function book($uuid)
    {
        $file = LessonBook::where('uuid', $uuid)->firstOrFail();
        $path = storage_path('app/books/'.$file->lesson_id.'/'.$file->filename);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Cache-Control' => 'no-cache, no-store, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => '0', 'Content-Type' =>'application/pdf'));
            
        }
        
        abort(404);
    }

    public function quiz($id){
        $quiz = LessonQuiz::where('lesson_id', $id)->orderBy('orders', 'asc')->get();
        return view('admins/manage/partner/verif_course/lesson/quiz.show')
        ->with(['quizzes' => $quiz]);
    }

    public function detailQuiz($id){
        $questions = QuizQuestion::where('quiz_id', $id)->orderBy('orders', 'asc')->get();
        return view('admins/manage/partner/verif_course/lesson/quiz.detail')
        ->with(['questions' => $questions]);
    }
}
