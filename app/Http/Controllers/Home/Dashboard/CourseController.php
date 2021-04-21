<?php

namespace App\Http\Controllers\Home\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Course,
    CourseLesson,
    LessonVideo,
    LessonBook,
    LessonQuiz,
    CustomerAnswerKey as UserAnswer,
    CustomerQuizScore as UserScore,
    CustomerVideoRating as UserVideoRating,
    CustomerBookRating as UserBookRating,
    CustomerQuizRating as UserQuizRating,
};

class CourseController extends Controller
{
    public function course($slug_course_name)
    {
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $slug_course_name)->firstOrFail();
        
        // dd($course);
        $data['course'] = $course;
        return view('homepage.pages.courses.enrolled.course')->with($data);
    }

    public function lessonRateItem(Request $request)
    {
        $user_auth = Auth::guard('web')->user();
        $item = (object) [ 'course_id' => $request->course_id, 'lesson_id' => $request->lesson_id, 'id' => $request->id, 'type' => $request->type, 'like' => ($request->like == 'true')? true : false ];
        $array_rating = ['like' => 0, 'dislike' => 0];

        if($item->like) {
            $array_rating['like'] = 1;
        } else {
            $array_rating['dislike'] = 1;
        }

        $lesson = CourseLesson::where([['course_id', $item->course_id], ['id', $item->lesson_id]])->firstOrFail();

        if($item->type == 'video') {
            $video = UserVideoRating::updateOrCreate(
                ['customer_id' => $user_auth->id, 'course_id' => $lesson->course_id, 'lesson_id' => $lesson->id, 'video_id' => $item->id],
                $array_rating,
            );
        }
        else if($item->type == 'book') {
            $book = UserBookRating::updateOrCreate(
                ['customer_id' => $user_auth->id, 'course_id' => $lesson->course_id, 'lesson_id' => $lesson->id, 'book_id' => $item->id],
                $array_rating,
            );
        }
        else if($item->type == 'quiz') {
            $quiz = UserQuizRating::updateOrCreate(
                ['customer_id' => $user_auth->id, 'course_id' => $lesson->course_id, 'lesson_id' => $lesson->id, 'quiz_id' => $item->id],
                $array_rating,
            );
        }

        $response = array(
            'status' => 'success',
            'message' => $request->message,
            'item' => $item,
            'rating' => $array_rating,
        );
        return response()->json($response); 
    }
}
