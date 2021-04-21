<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;
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

class LvLesson extends Component
{
    public $slug_course_name;
    
    public $lesson;

    public $course_id;

    public $item_id = null;
    
    public $selected_item =  [
        'type' => null,
        'video' => null,
        'book' => null,
        'quiz' => null,
    ];
    
    public function mount($title, $lesson_id)
    {
        $this->slug_course_name  = $title;
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();
        $this->course_id = $course->id;
        $this->lesson = CourseLesson::where([['course_id', $course->id], ['id', $lesson_id]])->first();
        
        $video = LessonVideo::where('lesson_id', $lesson_id)->first();
        if($video) {
            $this->selected_item['type'] = 'video';
            $this->selected_item['video'] = $video;
            $this->item_id = $video->id;
            return;
        }
        $book = LessonBook::where('lesson_id', $lesson_id)->first();
        if($book) {
            $this->selected_item['type'] = 'book';
            $this->selected_item['book'] = $book;
            $this->item_id = $book->id;
            return;
        }
        $quiz = LessonQuiz::where('lesson_id', $lesson_id)->first();
        if($quiz) {
            $this->selected_item['type'] = 'quiz';
            $this->selected_item['quiz'] = $quiz;
            $this->item_id = $quiz->id;
            return;
        }
    }
    public function render()
    {
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();
        
        // dd($course);
        $data['course'] = $course;
        // dd(gettype($this->selected_item['video']) == 'object');
        if(gettype($this->selected_item['video']) != 'object' && $this->selected_item['type'] == 'video') {
            $video = LessonVideo::where([['lesson_id', $this->lesson->id], ['id', $this->item_id]])->first();
            $this->selected_item['video'] = $video;
        }
        else if(gettype($this->selected_item['book']) != 'object' && $this->selected_item['type'] == 'book') {
            $book = LessonBook::where([['lesson_id', $this->lesson->id], ['id', $this->item_id]])->first();
            $this->selected_item['book'] = $book;
        }
        else if(gettype($this->selected_item['quiz']) != 'object' && $this->selected_item['type'] == 'quiz') {
            $quiz = LessonQuiz::where([['lesson_id', $this->lesson->id], ['id', $this->item_id]])->first();
            $this->selected_item['quiz'] = $quiz;
        }
        
        return view('homepage.pages.courses.enrolled.lv_lesson')
        ->with($data)
        ->layout('homepage.dashboard_layouts.lv_main');
    }
    
    public function setItem($item)
    {
        $item = (object) $item;
        $this->item_id = $item->id;
        if($item->type == 'video') {
            $video = LessonVideo::where([['lesson_id', $this->lesson->id], ['id', $item->id]])->first();
            $this->selected_item['type'] = 'video';
            $this->selected_item['video'] = $video;
            $this->selected_item['book'] = null;
            $this->selected_item['quiz'] = null;
            $this->dispatchBrowserEvent('videojs:load', ['id' => "video_{$item->id}", 'title' => $video->title]);
        }
        else if($item->type == 'book') {
            $book = LessonBook::where([['lesson_id', $this->lesson->id], ['id', $item->id]])->first();
            $this->selected_item['type'] = 'book';
            $this->selected_item['book'] = $book;
            $this->selected_item['video'] = null;
            $this->selected_item['quiz'] = null;
            $this->dispatchBrowserEvent('breadcrumb_title:load', ['title' => $book->title]);
        }
        else if($item->type == 'quiz') {
            $quiz = LessonQuiz::where([['lesson_id', $this->lesson->id], ['id', $item->id]])->first();
            $this->selected_item['type'] = 'quiz';
            $this->selected_item['quiz'] = $quiz;
            $this->selected_item['video'] = null;
            $this->selected_item['book'] = null;
            $this->dispatchBrowserEvent('breadcrumb_title:load', ['title' => $quiz->title]);
        }
    }

    public function likeItem($id, $type)
    {
        $item = [ 'id' => $id, 'type' => $type, 'like' => true ];
        $this->rateItem($item);
        $this->test = 'rendered';
    }

    public function dislikeItem($id, $type)
    {
        $item = [ 'id' => $id, 'type' => $type, 'like' => false ];
        $this->rateItem($item);
        $this->test = 'rendered';
    }
    
    public function rateItem($item)
    {
        $user_auth = Auth::guard('web')->user();
        $item = (object) $item;
        $array_rating = ['like' => 0, 'dislike' => 0];

        if($item->like) {
            $array_rating['like'] = 1;
        } else {
            $array_rating['dislike'] = 1;
        }

        if($item->type == 'video') {
            $video = UserVideoRating::updateOrCreate(
                ['customer_id' => $user_auth->id, 'course_id' => $this->course_id, 'lesson_id' => $this->lesson->id, 'video_id' => $item->id],
                $array_rating,
            );
            // $this->dispatchBrowserEvent('videojs:load', ['id' => "video_{$item->id}", 'title' => $video->title]);
        }
        else if($item->type == 'book') {
            $book = UserBookRating::updateOrCreate(
                ['customer_id' => $user_auth->id, 'course_id' => $this->course_id, 'lesson_id' => $this->lesson->id, 'book_id' => $item->id],
                $array_rating,
            );
        }
        else if($item->type == 'quiz') {
            $quiz = UserQuizRating::updateOrCreate(
                ['customer_id' => $user_auth->id, 'course_id' => $this->course_id, 'lesson_id' => $this->lesson->id, 'quiz_id' => $item->id],
                $array_rating,
            );
        }
    }

    public function resetQuiz($score_id)
    {
        $user_auth = Auth::guard('web')->user();
        $quiz = LessonQuiz::find($this->selected_item['quiz']['id']);
        if($quiz) {
            $user_score = UserScore::where([['id', $score_id], ['quiz_id', $quiz->id], ['customer_id', $user_auth->id]])->first();
            if($user_score && $user_score->score < $quiz->minimum_score) {
                $user_score->delete();
                UserAnswer::where([['quiz_id', $quiz->id], ['customer_id', $user_auth->id]])->delete();
            }
        }
    }

}
