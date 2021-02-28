<?php

namespace App\Http\Livewire\Partners\Courses\Lessons;

use Livewire\Component;
use App\Models\{
    CourseLesson as Lesson,
    LessonBook as MsBook,
    LessonVideo as MsVideo,
    LessonQuiz as MsQuiz,
};

class LvLearningSequence extends Component
{
    public $lesson;

    public $books;
    public $videos;
    public $quizzes;

    public function Mount(Lesson $lesson)
    {
        $this->lesson = $lesson;

        $this->books = MsBook::where('lesson_id', $this->lesson->id)->orderBy('orders', 'asc')->limit(5)->get();
        $this->videos = MsVideo::where('lesson_id', $this->lesson->id)->orderBy('orders', 'asc')->limit(5)->get();
        $this->quizzes = MsQuiz::where('lesson_id', $this->lesson->id)->orderBy('orders', 'asc')->limit(5)->get();
    }

    public function render()
    {
        return view('partners.course.lesson.learning_sequence.live-index')
        ->layout('partners.layouts.app-main');
    }
}
