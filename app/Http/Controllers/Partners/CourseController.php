<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{
	Course,
	Catalog,
	CatalogTopic,
    Level
};
use Illuminate\Support\Str;
use App\Http\Requests\Partner\CourseRequest;

class CourseController extends Controller
{
    public function index()
    {
        $data['courses'] = Course::with('lessons')->select('courses.id', 'courses.is_published', 'courses.title', 'courses.description', 'price', 'duration', 'courses.is_verified', 'courses.date_verified', 'catalog_topics.name as nama_catalog_topic', 'catalogs.name as nama_catalog', 'levels.name as nama_level')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('user_id', Auth('partner')->user()->id)
        ->orderBy('courses.id', 'DESC')->get();
        return view('partners.course.index')->with($data);
    }

    public function create()
    {
    	$catalogs = Catalog::all();
        $levels   = Level::all();
        return view('partners.course.create', compact('catalogs', 'levels'));
    }

    public function storeData($request, $act='create'){
        $cat_topic['name']       = $request['name'];
        $cat_topic['catalog_id'] = $request['catalog_id'];
        $cat_topic['created_by'] = \Auth::user()->id;
        $query_search = CatalogTopic::where('catalog_id', $request['catalog_id'])->where('name', $request['name'])->first();
        if($query_search) {
            $request['catalog_topic_id']    = $query_search->id;
        } else {
            $sv_catTopic             = CatalogTopic::create($cat_topic);
            $request['catalog_topic_id']    = $sv_catTopic->id;
        }

            //ini buat course
        $file                           = $request->file('filename');
        if ($file) {            
            $nama_file                      = Date('YmdHis').'_'.$request['title'].'_covers.'.$file->getClientOriginalExtension();
            $request['cover']               = $nama_file;
        }
        $request['user_id']             = \Auth::user()->id;
        if ($act == 'create') {
            $request['uuid']                = Str::uuid();
        }
        $request['slug_title']          = Str::slug($request['title']);
        if ($file){
            if($request['old_file'] && \Storage::exists(public_path('uploaded_files/courses/covers/'.$request['old_file'])))
                \Storage::deleteDirectory(public_path('uploaded_files/courses/covers/'.$request['old_file']));

            $file->move('uploaded_files/courses/covers/'. ($act == 'create' ? $request['uuid'] : $request['old_file']) , $nama_file);
        }            
        
    }

    public function store(CourseRequest $request)
    {
        $this->storeData($request);
        Course::create($request->except('_token', 'name', 'files', 'filename'));
        return redirect('partner/management/course/')->with('alert-message', 'Berhasil Menambah Data');
    }

    public function show($id){
    	$catalogs = Catalog::all();
        $course   = Course::with('skills.skill')->select('courses.id', 'courses.catalog_id', 'courses.uuid', 'courses.cover', 'courses.catalog_topic_id', 'courses.title', 'courses.description', 'courses.price', 'courses.duration',
            'catalog_topics.name as nama_catalog_topic',
            'catalogs.name as nama_catalog',
            'levels.name as nama_level', 'levels.description as desc_level')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('user_id', Auth('partner')->user()->id)
        ->findOrFail($id);
        return view('partners.course.show', compact('catalogs', 'course'));
    }

    public function edit($id){
        $catalogs = Catalog::all();
        $levels   = Level::all();
        $data     = Course::leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->select('courses.*', 'catalog_topics.name as name_catalog_topic')
        ->where('courses.id', $id)
        ->first();
        return view('partners.course.edit', compact('catalogs', 'levels', 'data'));
    }

    public function suggestTopic($cat_id){
        return CatalogTopic::where('catalog_id', $cat_id)->get();
    }

    public function update(CourseRequest $request, $id){
        $a = Course::findOrFail($id)->orderBy('id', 'DESC')->first();
        $request['old_file'] = $a->uuid;
        $this->storeData($request, 'update');
        Course::findOrFail($id)->update($request->except('_token', 'name', 'files', 'filename', 'old_file'));
        return redirect('partner/management/course/')->with('alert-message', 'Berhasil Mengubah Data');
    }

    public function publish($id){
        $upd = Course::findOrFail($id);
        $upd->is_published = true;
        $upd->save();
        return redirect('partner/management/course/')->with('alert-message', 'Berhasil Publish Course');
    }

    public function destroy($id){
        $data = Course::with('lessons')->select('courses.id', 'courses.uuid')->findOrFail($id);
        // delete cover
        if (\File::exists('uploaded_files/courses/covers/'.$data->uuid)) {
            \File::deleteDirectory(public_path('uploaded_files/courses/covers/'.$data->uuid));
        }
        foreach ($data->lessons as $value) {
            if (\Storage::exists('books/'.$value->course_id))
                \Storage::deleteDirectory('books/'.$value->course_id);

            if (\Storage::exists('videos/'.$value->course_id))
                \Storage::deleteDirectory('videos/'.$value->course_id);

            if (\Storage::exists('images/questions/'.$value->course_id))
                \Storage::deleteDirectory('images/questions/'.$value->course_id);
        }
        $data->delete();
        return redirect('partner/management/course/')->with('alert-message', 'Berhasil Menghapus Course');
    }
}
