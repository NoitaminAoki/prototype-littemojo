<?php

namespace App\Http\Controllers\Partners\Courses\Lessons\Quizzes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\QuizQuestion as Question;

class QuestionController extends Controller
{
    public function index($uuid)
    {
        $file = Question::where('uuid', $uuid)->firstOrFail();
        $path = storage_path('app/images/questions/lesson_'.$file->quiz->lesson_id.'/quiz_'.$file->quiz_id.'/'.$file->image);
        // dd($path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Cache-Control' => 'no-cache, no-store, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => '0', 'Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
}
