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
        'quiz.total_question' => 'required|string',
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

    public $title;
    public $total_question;
    public $iteration;


    public function Mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
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
        $this->validate([
            'title' => 'required|string',
            'total_question' => 'required|string',
        ]);
        $last_quiz = MsQuiz::where('lesson_id', $this->lesson->id)->orderBy('orders', 'desc')->first();

        $order = 1;

        if($last_quiz) {
            $order += $last_quiz->orders;
        }
        MsQuiz::create([
            'lesson_id' => $this->lesson->id,
            'title' => $this->title,
            'orders' => $order,
            'total_question' => $this->total_question
        ]);

        $this->resetInput();
        $this->setNotif('Successfully adding data.');
    }

    public function update()
    {
        $this->validate([
            'quiz.title' => 'required|string',
            'quiz.total_question' => 'required|string',
        ]);

        $this->quiz->save();
        $this->resetInput();
        $this->setNotif('Successfully updating data.');
    }
    
    public function delete($id)
    {
        $this->setQuiz($id);
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
        $this->reset(['title', 'total_question']);
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
