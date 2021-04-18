<?php

namespace App\Http\Controllers\Partners\Courses\Lessons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LessonVideo as Video;


class VideoController extends Controller
{
    public function index($uuid)
    {
        $file = Video::where('uuid', $uuid)->firstOrFail();
        $path = storage_path("app/videos/{$file->lesson->course_id}/{$file->lesson_id}/{$file->filename}");
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'video/mp4'));
        }
        
        abort(404);
    }
}
