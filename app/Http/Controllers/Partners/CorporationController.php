<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Corporation;
use Image;

class CorporationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corporations = Corporation::select('id', 'image', 'logo', 'thumbnail')
        ->latest()
        ->get();
        return view('partners.corporation.index', compact('corporations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partners.corporation.create');
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
            'logo'   => ['required', 'mimes:jpg,png,jpeg'],      
            'image'  => ['required', 'mimes:jpg,png,jpeg']
        ], [
            'logo.required'  => 'Logo wajib diisi',
            'logo.mimes'     => 'Extension logo harus .jpg, .png, .jpeg',
            'image.required' => 'Image wajib diisi',
            'image.mimes'    => 'Extension image harus .jpg, .png, .jpeg',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages());
        }else{
            $nama_logo      = Date('YmdHis').'_logo.'.$request->file('logo')->getClientOriginalExtension();
            $nama_image     = Date('YmdHis').'_image.'.$request->file('image')->getClientOriginalExtension();
            $nama_thumbnail = Date('YmdHis').'_thumbnail.'.$request->file('image')->getClientOriginalExtension();
            $request->file('logo')->move('uploaded_files/corporation/', $nama_logo);
            $request->file('image')->move('uploaded_files/corporation/', $nama_image);
            copy('uploaded_files/corporation/'.$nama_image, public_path('uploaded_files/corporation/'.$nama_thumbnail));
            
            $logopath = public_path('uploaded_files/corporation/'.$nama_logo);
            $img = Image::make($logopath);
            $img->resize(null, 70, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($logopath);

            $thumbnailpath = public_path('uploaded_files/corporation/'.$nama_thumbnail);
            $img = Image::make($thumbnailpath);
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $new['logo']        = $nama_logo;
            $new['image']       = $nama_image;
            $new['thumbnail']   = $nama_thumbnail;
            Corporation::create($new);

            return redirect('partner/management/corporation/')->with('alert-message', 'Berhasil Menambah Data');
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
        $corporation = Corporation::select('id', 'image', 'logo', 'thumbnail')
        ->findOrFail($id);
        return view('partners.corporation.edit', compact('corporation'));
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
            'logo'   => ['required', 'mimes:jpg,png,jpeg'],      
            'image'  => ['required', 'mimes:jpg,png,jpeg']
        ], [
            'logo.required'  => 'Logo wajib diisi',
            'logo.mimes'     => 'Extension logo harus .jpg, .png, .jpeg',
            'image.required' => 'Image wajib diisi',
            'image.mimes'    => 'Extension image harus .jpg, .png, .jpeg',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages());
        }else{
            $upd = Corporation::findOrFail($id);
            $nama_logo      = Date('YmdHis').'_logo.'.$request->file('logo')->getClientOriginalExtension();
            $nama_image     = Date('YmdHis').'_image.'.$request->file('image')->getClientOriginalExtension();
            $nama_thumbnail = Date('YmdHis').'_thumbnail.'.$request->file('image')->getClientOriginalExtension();
            unlink(public_path('uploaded_files/corporation/'.$upd->logo));
            unlink(public_path('uploaded_files/corporation/'.$upd->image));
            unlink(public_path('uploaded_files/corporation/'.$upd->thumbnail));
            $request->file('logo')->move('uploaded_files/corporation/', $nama_logo);
            $request->file('image')->move('uploaded_files/corporation/', $nama_image);
            copy('uploaded_files/corporation/'.$nama_image, public_path('uploaded_files/corporation/'.$nama_thumbnail));
            
            $logopath = public_path('uploaded_files/corporation/'.$nama_logo);
            $img = Image::make($logopath);
            $img->resize(null, 70, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($logopath);

            $thumbnailpath = public_path('uploaded_files/corporation/'.$nama_thumbnail);
            $img = Image::make($thumbnailpath);
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $upd->logo        = $nama_logo;
            $upd->image       = $nama_image;
            $upd->thumbnail   = $nama_thumbnail;
            $upd->save();

            return redirect('partner/management/corporation/')->with('alert-message', 'Berhasil Mengubah Data');
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
        Corporation::findOrFail($id)->delete();
        return redirect('partner/management/corporation/')->with('alert-message', 'Berhasil Menghapus Data');
    }
}
