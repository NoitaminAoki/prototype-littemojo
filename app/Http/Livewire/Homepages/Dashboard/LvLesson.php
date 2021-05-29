<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
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
    CustomerLessonProgress as UserProgress,
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

    public $last_item;
    
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
        
        $last_item = $this->getLastItem($this->lesson);
        $this->last_item = $last_item;
        
        if(!$last_item['id']) {
            abort('404');
        }

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

    public function getLastItem($lesson)
    {
        $total_items = $lesson->getTotalItems();
        $data = ['id' => null, 'type' => null];
        if($total_items->total_quizzes > 0) {
            $quiz = LessonQuiz::orderBy('id', 'desc')->first();
            $data['id'] = $quiz->id;
            $data['type'] = 'quiz';
        }
        else if($total_items->total_books > 0) {
            $book = LessonBook::orderBy('id', 'desc')->first();
            $data['id'] = $book->id;
            $data['type'] = 'book';
        }
        else if($total_items->total_videos > 0) {
            $video = LessonVideo::orderBy('id', 'desc')->first();
            $data['id'] = $video->id;
            $data['type'] = 'video';
        }

        return $data;
    }
    
    public function nextItem($current_item, $item)
    {
        $user_auth = Auth::guard('web')->user();
        $current_item = (object) $current_item;
        $data = ['customer_id' => $user_auth->id, 'course_id' => $this->course_id, 'lesson_id' => $this->lesson->id];
        $data[$current_item->type.'_id'] = $current_item->id;
        $data['type'] = $current_item->type;
        if($current_item->type == "quiz") {
            $user_score = UserScore::select('customer_quiz_scores.*', 'quiz.minimum_score as quiz_min_score')
            ->join('lesson_quizzes as quiz', 'quiz.id', 'customer_quiz_scores.quiz_id')
            ->where([['customer_quiz_scores.quiz_id', $current_item->id], ['customer_quiz_scores.customer_id', $user_auth->id]])
            ->first();
            if(!$user_score) {
                return $this->dispatchBrowserEvent('notification:alert', ['message' => "You need to finish the quiz first!"]);
            }
            if($user_score && $user_score->score < $user_score->quiz_min_score) {
                return $this->dispatchBrowserEvent('notification:alert', ['message' => "You FAILED the Quiz, try again!"]);
            }
        }
        $lesson_progress = UserProgress::firstOrCreate($data);
        $this->setItem($item);
    }
    
    public function setItem($item)
    {
        $item = (object) $item;
        $this->item_id = $item->id;
        $is_last_item = false;
        
        if($this->last_item['id'] == $item->id && $this->last_item['type'] == $item->type) {
            $is_last_item = true;
        }

        if($item->type == 'video') {
            $video = LessonVideo::where([['lesson_id', $this->lesson->id], ['id', $item->id]])->first();
            $this->selected_item['type'] = 'video';
            $this->selected_item['video'] = $video;
            $this->selected_item['book'] = null;
            $this->selected_item['quiz'] = null;
            $this->dispatchBrowserEvent('videojs:load', ['id' => "video_{$item->id}", 'title' => $video->title, 'is_last_item' => $is_last_item]);
        }
        else if($item->type == 'book') {
            $book = LessonBook::where([['lesson_id', $this->lesson->id], ['id', $item->id]])->first();
            $this->selected_item['type'] = 'book';
            $this->selected_item['book'] = $book;
            $this->selected_item['video'] = null;
            $this->selected_item['quiz'] = null;
            $this->dispatchBrowserEvent('breadcrumb_title:load', ['title' => $book->title, 'is_last_item' => $is_last_item]);
        }
        else if($item->type == 'quiz') {
            $quiz = LessonQuiz::where([['lesson_id', $this->lesson->id], ['id', $item->id]])->first();
            $this->selected_item['type'] = 'quiz';
            $this->selected_item['quiz'] = $quiz;
            $this->selected_item['video'] = null;
            $this->selected_item['book'] = null;
            $this->dispatchBrowserEvent('breadcrumb_title:load', ['title' => $quiz->title, 'is_last_item' => $is_last_item]);
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

    public function finishLesson($current_item)
    {
        $user_auth = Auth::guard('web')->user();
        $current_item = (object) $current_item;
        $data = ['customer_id' => $user_auth->id, 'course_id' => $this->course_id, 'lesson_id' => $this->lesson->id];
        $data[$current_item->type.'_id'] = $current_item->id;
        $data['type'] = $current_item->type;
        if($current_item->type == "quiz") {
            $user_score = UserScore::select('customer_quiz_scores.*', 'quiz.minimum_score as quiz_min_score')
            ->join('lesson_quizzes as quiz', 'quiz.id', 'customer_quiz_scores.quiz_id')
            ->where([['customer_quiz_scores.quiz_id', $current_item->id], ['customer_quiz_scores.customer_id', $user_auth->id]])
            ->first();
            if(!$user_score) {
                return $this->dispatchBrowserEvent('notification:alert', ['message' => "You need to finish the quiz first!"]);
            }
            if($user_score && $user_score->score < $user_score->quiz_min_score) {
                return $this->dispatchBrowserEvent('notification:alert', ['message' => "You FAILED the Quiz, try again!"]);
            }
        }
        $lesson_progress = UserProgress::firstOrCreate($data);
        $user_progress = UserProgress::where(Arr::only($data, ['customer_id', 'course_id', 'lesson_id']))->get();
        if(count($user_progress) == $this->lesson->getTotalItems()->total) {
            return redirect()->route('home.dashboard.course.lesson.rating', ['title' => $this->slug_course_name, 'lesson_id' => $this->lesson->id]);
        } else {
            return $this->dispatchBrowserEvent('notification:alert', ['message' => "Sorry, please try again!"]);
        }
    }
    
}
