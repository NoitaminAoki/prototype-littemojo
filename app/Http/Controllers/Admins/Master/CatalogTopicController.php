<?php

namespace App\Http\Controllers\Admins\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Catalog, CatalogTopic} ;

class CatalogTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalog_topics = CatalogTopic::select('catalog_topics.id', 'catalog_topics.name', 'catalog_topics.catalog_id', 'catalogs.name as nama_catalog', 'users.name as created_by')
        ->orderBy('id', 'DESC')
        ->leftJoin('users', 'users.id', 'catalog_topics.created_by')
        ->leftJoin('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
        ->get();
        return view('admins/master/catalog_topic.index', compact('catalog_topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catalogs = Catalog::all();
        return view('admins/master/catalog_topic.create', compact('catalogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make(request()->all(), [
            'catalog_id' => ['required'],
            'name'       => ['required']
        ], [
            'catalog_id.required' => 'Catalog wajib diisi',
            'name.required'       => 'Topic wajib diisi'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages())->withInput();
        }else{            
            $request['created_by'] = \Auth::user()->id;
            CatalogTopic::create($request->except('_token'));
            return redirect('admin/management/catalog_topic')->with('alert-message', 'Berhasil Menambah Data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalog_topic = CatalogTopic::findOrFail($id);
        $catalogs = Catalog::all();
        return view('admins/master/catalog_topic.edit', compact('id', 'catalog_topic', 'catalogs'));
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
        $validator = \Validator::make(request()->all(), [
            'catalog_id' => ['required'],
            'name'       => ['required']
        ], [
            'catalog_id.required' => 'Catalog wajib diisi',
            'name.required'       => 'Topic wajib diisi'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages())->withInput();
        }else{            
            $request['updated_by'] = \Auth::user()->id;
            CatalogTopic::findOrFail($id)->update($request->except('_token'));
            return redirect('admin/management/catalog_topic')->with('alert-message', 'Berhasil Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CatalogTopic::findOrFail($id)->delete();
        return redirect('admin/management/catalog_topic')->with('alert-message', 'Berhasil Menghapus Data');
    }
}
