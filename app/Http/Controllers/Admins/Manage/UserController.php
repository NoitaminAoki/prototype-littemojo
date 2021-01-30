<?php

namespace App\Http\Controllers\Admins\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('name', 'email', 'status', 'id')
                    ->orderBy('id', 'DESC')->get();
        return view('admins/manage/user.index', compact('users'));
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
        $catalog = User::findOrFail($id);
        return view('admins/manage/user.edit', compact('id', 'catalog'));
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
            'name'  => ['required'],
            'email' => ['required'],
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Nama wajib diisi'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages())->withInput();
        }else{
            User::findOrFail($id)->update($request->except('_token'));
            return redirect('admin/management/user')->with('alert-message', 'Berhasil Mengubah Data');
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
        $check = User::where('id', $id)->first();
        User::where('id', $id)->update(['status' => ($check->status == 'A' ? 'D' : 'A')]);
        return redirect('admin/management/user')->with('alert-message', 'Berhasil '.($check->status == 'A' ? 'Menonaktifkan' : 'Mengaktifkan').' User');
    }
}
