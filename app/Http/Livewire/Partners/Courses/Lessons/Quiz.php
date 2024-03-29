<?php

namespace App\Http\Livewire\Partners\Courses\Lessons;

use Livewire\Component;
use App\Models\{
    CourseLesson as Lesson,
    LessonQuiz as MsQuiz
};
use App\Helpers\Converter;

class Quiz extends Component
{

    protected $rules = [
        'title' => 'required|string',
        'quiz.title' => 'required|string',
        'quiz.minimum_score' => 'required|max:100',
    ];
    
    public $orders_id;

    public $notification = [
        'isOpen' => false, 
        'message' => "",
    ];

    public $isOpenOrder = false;

    public $lesson;
    public $quiz;
    public $quizzes;

    public $user_id;
    public $course_user_id;

    public $title;
    public $minimum_score;
    public $iteration;


    public function Mount(Lesson $lesson)
    {
        $this->user_id = \Auth::user()->id;
        $this->lesson = $lesson;
        $this->course_user_id = $this->lesson->course->user_id;
    }

    public function render()
    {
        $this->quizzes = MsQuiz::where('lesson_id', $this->lesson->id)->orderBy('orders', 'asc')->get();
        return view('partners.course.lesson.quiz.live-index')
        ->with(['quizzes' => $this->quizzes])
        ->layout('partners.layouts.app-main');
    }

    public function store()
    {
        if ($this->course_user_id == $this->user_id) {
            $this->validate([
                'title' => 'required|string',
                'minimum_score' => 'required|max:100',
            ]);
            $last_quiz = MsQuiz::where('lesson_id', $this->lesson->id)->orderBy('orders', 'desc')->first();

            $order = 1;

            if($last_quiz) {
                $order += $last_quiz->orders;
            }
            MsQuiz::create([
                'lesson_id' => $this->lesson->id,
                'user_id' => $this->user_id,
                'title' => $this->title,
                'orders' => $order,
                'minimum_score' => $this->minimum_score
            ]);

            $this->resetInput();
            $this->setNotif('Successfully adding data.');
        }else{
            abort(404);
        }
    }

    public function update()
    {
        $this->validate([
            'quiz.title' => 'required|string',
            'quiz.minimum_score' => 'required|max:100',
        ]);

        $this->quiz->save();
        $this->resetInput();
        $this->setNotif('Successfully updating data.');
    }
    
    public function delete($id)
    {
        $this->setQuiz($id);
        $course_id = Lesson::where('id', $this->quiz->lesson_id)->value('course_id');
        \Storage::deleteDirectory('images/questions/'.$course_id.'/lesson_'.$this->quiz->lesson_id);
        $this->quiz->delete();
        $this->resetInput();
        $this->setNotif('Successfully deleting data.');
    }

    public function setQuiz($id)
    {
        $this->quiz = MsQuiz::find($id);
    }

    public function resetInput()
    {
        $this->reset(['title', 'minimum_score']);
        $this->iteration++;
    }

    public function setNotif($message)
    {
        $this->notification = [
            'isOpen' => true,
            'message' => $message
        ];
    }

    public function resetNotif()
    {
        $this->notification = [
        'isOpen' => false,
        'message' => ""
        ];
    }

    public function openOrder($state = true)
    {
        $this->isOpenOrder = $state;
    }

    public function submitOrder($orders_id)
    {
        $this->orders_id = $orders_id;
        $this->validate([
            'orders_id.*' => 'integer',
        ]);
        foreach ($this->quizzes as $quiz) {
            $order = array_search($quiz->id, $this->orders_id) + 1;
            if($quiz->orders <> $order) {
                $quiz->orders = $order;
                $quiz->save();
            }
        }
        $this->setNotif('Successfully reordering data.');
    }

    
}
