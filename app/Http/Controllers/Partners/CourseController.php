<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Course,
	Catalog,
	CatalogTopic,
    Level
};

class CourseController extends Controller
{
    public function index()
    {
        $data['courses'] = Course::with('lessons')->select('courses.id', 'courses.is_published', 'courses.title', 'courses.description', 'price', 'duration', 'courses.is_verified', 'courses.date_verified', 'catalog_topics.name as nama_catalog_topic', 'catalogs.name as nama_catalog', 'levels.name as nama_level')
                            ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
    						->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
                            ->leftJoin('levels', 'levels.id', 'courses.level_id')
        					->orderBy('courses.id', 'DESC')->get();
        return view('partners.course.index')->with($data);
    }

    public function create()
    {
    	$catalogs = Catalog::all();
        $levels   = Level::all();
        return view('partners.course.create', compact('catalogs', 'levels'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = \Validator::make(request()->all(), [
            'catalog_id'  => ['required'],
            'level_id'    => ['required'],
            'name' 		  => ['required'],
            'title' 	  => ['required', 'max:100'],
            'description' => ['required'],
            'price'       => ['required'],
            'duration'    => ['required'],
            'filename'       => ['required', 'mimes:jpg,png,jpeg']
        ], [
            'catalog_id.required'  => 'Nama Catalog wajib diisi',
            'level_id.required'    => 'Level wajib diisi',
            'name.required' 	   => 'Nama Catalog Topic wajib diisi',
            'title.required' 	   => 'Title wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'price.required' 	   => 'Harga wajib diisi',
            'duration.required'    => 'Durasi wajib diisi',
            'filename.required'       => 'Cover wajib diisi',
            'filename.mimes'          => 'Extension cover harus .jpg, .png, .jpeg',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages())->withInput();
        }else{            
        	// bikin catalog topic dulu
        	$cat_topic['name'] 	 	 = $request['name'];
        	$cat_topic['catalog_id'] = $request['catalog_id'];
        	$cat_topic['created_by'] = \Auth::user()->id;
            $query_search = CatalogTopic::where('catalog_id', $request['catalog_id'])->where('name', $request['name'])->first();
            if($query_search) {
                $request['catalog_topic_id'] 	= $query_search->id;
            } else {
                $sv_catTopic 			 = CatalogTopic::create($cat_topic);
                $request['catalog_topic_id'] 	= $sv_catTopic->id;
            }

            //ini buat course
            $file                           = $request->file('filename');
            $nama_file                      = Date('YmdHis').'_'.$request['title'].'_covers.'.$file->getClientOriginalExtension();
            $request['user_id'] 	  		= \Auth::user()->id;
            $request['cover']               = $nama_file;
            $request['uuid']                = \Str::uuid();
            $file->move('uploaded_files/courses/covers/'.$request['uuid'], $nama_file);
            // \Storage::putFileAs('covers/'.\Auth::user()->id, $file , $nama_file);
            Course::create($request->except('_token', 'name', 'files', 'filename'));
            return redirect('partner/management/course/')->with('alert-message', 'Berhasil Menambah Data');
        }
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
        					->findOrFail($id);
        return view('partners.course.show', compact('catalogs', 'course'));
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
