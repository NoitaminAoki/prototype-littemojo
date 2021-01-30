<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Course,
	Catalog,
	CatalogTopic
};

class CourseController extends Controller
{
    public function index()
    {
        $data['courses'] = Course::select('courses.id', 'title', 'description', 'price', 'catalog_topics.name as nama_catalog_topic',
        					'catalogs.name as nama_catalog')
    						 ->join('catalog_topics', 'catalog_topics.id', 'courses.id')
    						 ->join('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
        					 ->orderBy('courses.id', 'DESC')->get();
        return view('partners.course.index')->with($data);
    }

    public function create()
    {
    	$catalogs = Catalog::all();
        return view('partners.course.create', compact('catalogs'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make(request()->all(), [
            'catalog_id'  => ['required'],
            'name' 		  => ['required'],
            'title' 	  => ['required', 'max:100'],
            'description' => ['required'],
            'price'       => ['required']
        ], [
            'catalog_id.required'  => 'Nama Catalog wajib diisi',
            'name.required' 	   => 'Nama Catalog Topic wajib diisi',
            'title.required' 	   => 'Title wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'price.required' 	   => 'Harga wajib diisi',
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
            $request['user_id'] 	  		= \Auth::user()->id;
            $request['catalog_topic_id'] 	= $sv_catTopic->id;
            Course::create($request->except('_token', 'name'));
            return redirect('partner/management/course/')->with('alert-message', 'Berhasil Menambah Data');
        }
    }

    public function show($id){
    	$catalogs = Catalog::all();
    	$course   = Course::select('courses.id', 'courses.catalog_id', 'courses.catalog_topic_id', 'title', 'description', 'price', 'catalog_topics.name as nama_catalog_topic',
        						'catalogs.name as nama_catalog')
    						 ->join('catalog_topics', 'catalog_topics.id', 'courses.id')
    						 ->join('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
        					 ->findOrFail($id);
        return view('partners.course.show', compact('catalogs', 'course'));
    }
}
