<?php

namespace App\Http\Controllers\Admins\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::select('levels.id', 'levels.name', 'levels.difficulty', 'levels.description', 'users.name as created_by')
        ->orderBy('id', 'DESC')
        ->leftJoin('users', 'users.id', 'levels.created_by')
        ->get();
        return view('admins/master/level.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins/master/level.create');
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
            'name'        => ['required'],
            'difficulty'  => ['required'],
            'description' => ['required']
        ], [
            'name.required'        => 'Nama Level wajib diisi',
            'difficulty.required'  => 'Kesulitan wajib diisi',
            'description.required' => 'Deskripsi wajib diisi'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages())->withInput();
        }else{            
            $request['created_by'] = \Auth::user()->id;
            Level::create($request->except('_token'));
            return redirect('admin/management/level')->with('alert-message', 'Berhasil Menambah Data');
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
        $level = Level::findOrFail($id);
        return view('admins/master/level.edit', compact('id', 'level'));
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
            'name'        => ['required'],
            'difficulty'  => ['required'],
            'description' => ['required']
        ], [
            'name.required'        => 'Nama Level wajib diisi',
            'difficulty.required'  => 'Kesulitan wajib diisi',
            'description.required' => 'Deskripsi wajib diisi'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages())->withInput();
        }else{
            $request['updated_by'] = \Auth::user()->id;
            Level::findOrFail($id)->update($request->except('_token'));
            return redirect('admin/management/level')->with('alert-message', 'Berhasil Mengubah Data');
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
        Level::findOrFail($id)->delete();
        return redirect('admin/management/level')->with('alert-message', 'Berhasil Menghapus Data');
    }
}
