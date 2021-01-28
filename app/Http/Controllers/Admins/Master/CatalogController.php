<?php

namespace App\Http\Controllers\Admins\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::select('catalogs.id', 'catalogs.name', 'users.name as created_by')
        ->orderBy('id', 'DESC')
        ->leftJoin('users', 'users.id', 'catalogs.created_by')
        ->get();
        return view('admins/master/catalog.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins/master/catalog.create');
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
            'name' => ['required']
        ], [
            'name.required' => 'Nama wajib diisi'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages())->withInput();
        }else{            
            $request['created_by'] = \Auth::user()->id;
            Catalog::create($request->except('_token'));
            return redirect('admin/management/catalog')->with('alert-message', 'Berhasil Menambah Data');
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
        $catalog = Catalog::findOrFail($id);
        return view('admins/master/catalog.edit', compact('id', 'catalog'));
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
            'name' => ['required']
        ], [
            'name.required' => 'Nama wajib diisi'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages())->withInput();
        }else{
            $request['updated_by'] = \Auth::user()->id;
            Catalog::findOrFail($id)->update($request->except('_token'));
            return redirect('admin/management/catalog')->with('alert-message', 'Berhasil Mengubah Data');
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
        Catalog::findOrFail($id)->delete();
        return redirect('admin/management/catalog')->with('alert-message', 'Berhasil Menghapus Data');
    }
}
