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
        $data['courses'] = Course::select('courses.id', 'courses.title', 'courses.description', 'price', 'duration', 'catalog_topics.name as nama_catalog_topic', 'catalogs.name as nama_catalog', 'levels.name as nama_level')
    						 ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.id')
    						 ->leftJoin('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
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
        	$sv_catTopic 			 = CatalogTopic::create($cat_topic);

            //ini buat course
            $file                           = $request->file('filename');
            $nama_file                      = Date('YmdHis').'_'.$request['title'].'_covers.'.$file->getClientOriginalExtension();
            $request['user_id'] 	  		= \Auth::user()->id;
            $request['catalog_topic_id'] 	= $sv_catTopic->id;
            $request['cover']               = $nama_file;
            \Storage::putFileAs('covers/'.\Auth::user()->id, $file , $nama_file);
            Course::create($request->except('_token', 'name', 'files', 'filename'));
            return redirect('partner/management/course/')->with('alert-message', 'Berhasil Menambah Data');
        }
    }

    public function show($id){
    	$catalogs = Catalog::all();
        $course   = Course::select('courses.id', 'courses.catalog_id', 'courses.cover', 'courses.catalog_topic_id', 'courses.title', 'courses.description', 'courses.price', 'courses.duration',
                            'catalog_topics.name as nama_catalog_topic',
                            'catalogs.name as nama_catalog',
                            'levels.name as nama_level', 'levels.description as desc_level')
    						->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.id')
    						->leftJoin('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
                            ->leftJoin('levels', 'levels.id', 'courses.level_id')
        					->findOrFail($id);
        return view('partners.course.show', compact('catalogs', 'course'));
    }

    public function getFile($nama_file){
        $path = storage_path('app/covers/1'.'/'.$nama_file);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Cache-Control' => 'no-cache, no-store, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => '0', 'Content-Type' =>'image/jpeg'));
        }
        
        abort(404);
    }
}
