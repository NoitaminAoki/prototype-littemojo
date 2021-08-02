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
        $corporations = Corporation::select('id', 'name', 'image', 'logo', 'thumbnail', 'uuid')
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
            'image'  => ['required', 'mimes:jpg,png,jpeg'],
            'name'   => ['required']
        ], [
            'logo.required'  => 'Logo wajib diisi',
            'logo.mimes'     => 'Extension logo harus .jpg, .png, .jpeg',
            'image.required' => 'Image wajib diisi',
            'image.mimes'    => 'Extension image harus .jpg, .png, .jpeg',
            'name.required'  => 'Nama wajib diisi',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages());
        }else{
            $uuid_corporation = \Str::uuid();
            $nama_logo      = Date('YmdHis').'_logo.'.$request->file('logo')->getClientOriginalExtension();
            $nama_image     = Date('YmdHis').'_image.'.$request->file('image')->getClientOriginalExtension();
            $nama_thumbnail = Date('YmdHis').'_thumbnail.'.$request->file('image')->getClientOriginalExtension();
            $request->file('logo')->move("uploaded_files/corporation/{$uuid_corporation}/", $nama_logo);
            $request->file('image')->move("uploaded_files/corporation/{$uuid_corporation}/", $nama_image);
            copy("uploaded_files/corporation/{$uuid_corporation}/".$nama_image, public_path("uploaded_files/corporation/{$uuid_corporation}/".$nama_thumbnail));
            
            $logopath = public_path("uploaded_files/corporation/{$uuid_corporation}/{$nama_logo}");
            $img = Image::make($logopath);
            $img->resize(null, 70, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($logopath);

            $thumbnailpath = public_path("uploaded_files/corporation/{$uuid_corporation}/{$nama_thumbnail}");
            $img = Image::make($thumbnailpath);
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $new['uuid']            = $uuid_corporation;
            $new['name']            = $request['name'];
            $new['partner_id']      = \Auth::user()->id;;
            $new['logo']            = $nama_logo;
            $new['image']           = $nama_image;
            $new['thumbnail']       = $nama_thumbnail;
            $new['path']            = "uploaded_files/corporation/{$uuid_corporation}/{$nama_image}";
            $new['path_logo']       = "uploaded_files/corporation/{$uuid_corporation}/{$nama_logo}";
            $new['path_thumbnail']  = "uploaded_files/corporation/{$uuid_corporation}/{$nama_thumbnail}";
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
        $corporation = Corporation::select('id', 'name', 'image', 'logo', 'thumbnail')
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
            'logo'   => ['mimes:jpg,png,jpeg'],      
            'image'  => ['mimes:jpg,png,jpeg'],
            'name'   => ['required']
        ], [
            'logo.mimes'     => 'Extension logo harus .jpg, .png, .jpeg',
            'image.mimes'    => 'Extension image harus .jpg, .png, .jpeg',
            'name.required'  => 'Nama wajib diisi',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->getMessages());
        }else{
            $upd = Corporation::findOrFail($id);
            $nama_logo = ($request->file('logo') ? Date('YmdHis').'_logo.'.$request->file('logo')->getClientOriginalExtension() : $upd->logo);
            $nama_image = ($request->file('image') ? Date('YmdHis').'_image.'.$request->file('image')->getClientOriginalExtension() : $upd->image);
            $nama_thumbnail = ($request->file('image') ? Date('YmdHis').'_thumbnail.'.$request->file('image')->getClientOriginalExtension() : $upd->thumbnail);
            if ($request->file('logo')) {
                $logo_path = public_path("uploaded_files/corporation/{$upd->uuid}/".$upd->logo);
                if (file_exists($logo_path))
                    unlink($logo_path);

                $request->file('logo')->move("uploaded_files/corporation/{$upd->uuid}/", $nama_logo);
                $upd->path_logo = "uploaded_files/corporation/{$upd->uuid}/{$nama_logo}";
            }
            if ($request->file('image')) {
                if (file_exists(public_path("uploaded_files/corporation/{$upd->uuid}/".$upd->image)))
                    unlink(public_path("uploaded_files/corporation/{$upd->uuid}/".$upd->image));

                if (file_exists(public_path("uploaded_files/corporation/{$upd->uuid}/".$upd->thumbnail)))
                    unlink(public_path("uploaded_files/corporation/{$upd->uuid}/".$upd->thumbnail));

                $request->file('image')->move("uploaded_files/corporation/{$upd->uuid}/", $nama_image);
                copy("uploaded_files/corporation/{$upd->uuid}/".$nama_image, public_path("uploaded_files/corporation/{$upd->uuid}/".$nama_thumbnail));
                
                $logopath = public_path("uploaded_files/corporation/{$upd->uuid}/".$nama_logo);
                $img = Image::make($logopath);
                $img->resize(null, 70, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($logopath);
                
                $thumbnailpath = public_path("uploaded_files/corporation/{$upd->uuid}/".$nama_thumbnail);
                $img = Image::make($thumbnailpath);
                $img->resize(120, 120, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($thumbnailpath);
                
                $upd->path = "uploaded_files/corporation/{$upd->uuid}/{$nama_image}";
                $upd->path_thumbnail = "uploaded_files/corporation/{$upd->uuid}/{$nama_thumbnail}";
            }                                                        
            
            

            // $upd->uuid        = \Str::uuid();
            $upd->name        = $request['name'];
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
