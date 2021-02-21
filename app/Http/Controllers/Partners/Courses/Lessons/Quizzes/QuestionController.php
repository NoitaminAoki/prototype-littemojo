<?php

namespace App\Http\Controllers\Partners\Courses\Lessons\Quizzes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\{
    QuizQuestion as Question,
    QuestionOption as Option,
};

class QuestionController extends Controller
{
    public function index($uuid)
    {
        $file = Question::where('uuid', $uuid)->firstOrFail();
        $path = storage_path('app/'.$file->path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Cache-Control' => 'no-cache, no-store, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => '0', 'Content-Type' =>'image'));
            
        }
        
        abort(404);
    }

    public function optionIndex($uuid)
    {
        $file = Option::where('uuid', $uuid)->firstOrFail();
        $path = storage_path('app/'.$file->path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Cache-Control' => 'no-cache, no-store, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => '0', 'Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
}
