<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreValidation;
use App\Http\Requests\ArticleUpdateValidation;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('is_publish', true)->paginate(15);
        return view('admins.manage.blog.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.manage.blog.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleStoreValidation $request)
    {
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->img = $request->file('img')->store('public/files');
        $blog->content = $request->content;
        $blog->is_publish = true;
        $blog->user_id = auth()->id();
        $blog->save();

        return redirect()->route('admin.blog.index');
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
        $article = Blog::findOrFail($id);
        return view('admins.manage.blog.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateValidation $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        if($request->has('img')) {
            Storage::delete($blog->img);
            $blog->img = $request->file('img')->store('public/files');
        }
        $blog->content = $request->content;
        $blog->is_publish = true;
        $blog->user_id = auth()->id();
        $blog->save();

        return redirect()->route('admin.blog.index');
    }

    public function markAsHighlight($id)
    {
        $isHighlight = Blog::findOrFail($id)->is_highlight;
        Blog::findOrFail($id)->update([
            'is_highlight' => !$isHighlight
        ]);

        $messageSession = '';
        if (!$isHighlight) {
            $messageSession = 'Successfully mark article';
        }
        else {
            $messageSession = 'Successfully unmark article';
        }

        return redirect()->back()->with('success', $messageSession);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->back();
    }
}
