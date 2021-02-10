<?php

namespace App\Http\Controllers\Partners\Courses\Lessons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LessonBook as Books;


class BookController extends Controller
{
    public function index($uuid)
    {
        $file = Books::where('uuid', $uuid)->first();
        $path = storage_path('app/books/'.$file->filename);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Cache-Control' => 'no-cache, no-store, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => '0', 'Content-Type' =>'application/pdf'));
            
        }
        
        abort(404);
    }
}
