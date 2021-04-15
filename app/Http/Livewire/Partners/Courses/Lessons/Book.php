<?php

namespace App\Http\Livewire\Partners\Courses\Lessons;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    CourseLesson as Lesson,
    LessonBook as MsBook
};
use App\Helpers\Converter;

class Book extends Component
{
    use WithFileUploads;

    protected $rules = [
        'title' => 'required|string',
        'file' => 'required|mimes:pdf|max:5120',
        'book.title' => 'required|string',
        'update_file' => 'mimes:pdf|max:5120',
    ];
    
    public $orders_id;

    public $notification = [
        'isOpen' => false, 
        'message' => "",
    ];

    public $isOpenOrder = false;

    public $lesson;
    public $book;
    public $books;

    public $user_id;
    public $course_user_id;

    public $title;
    public $file;
    public $update_file;
    public $iteration;


    public function Mount(Lesson $lesson)
    {
        $this->user_id = \Auth::user()->id;
        $this->lesson = $lesson;
        $this->course_user_id = $this->lesson->course->user_id;
    }

    public function render()
    {
        $this->books = MsBook::where('lesson_id', $this->lesson->id)->orderBy('orders', 'asc')->get();
        return view('partners.course.lesson.book.live-index')
        ->with(['books' => $this->books])
        ->layout('partners.layouts.app-main');
    }

    public function upload()
    {
        if ($this->course_user_id == $this->user_id) {
            $this->validate([
                'title' => 'required|string',
                'file' => 'required|mimes:pdf|max:5120'
            ]);

            $name = Date('YmdHis').'_books.'.$this->file->extension();
            $course_id = Lesson::where('id', $this->lesson->id)->value('course_id');

            $path = Storage::putFileAs('books/'.$course_id.'/'.$this->lesson->id, $this->file, $name);

            $last_book = MsBook::where('lesson_id', $this->lesson->id)->orderBy('orders', 'desc')->first();

            $order = 1;

            if($last_book) {
                $order += $last_book->orders;
            }

            MsBook::create([
                'lesson_id' => $this->lesson->id,
                'user_id' => $this->user_id,
                'uuid' => Str::uuid(),
                'title' => $this->title,
                'orders' => $order,
                'filename' => $name,
                'size' => Converter::formatBytes($this->file->getSize())
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
            'book.title' => 'required|string',
            'update_file' => 'nullable|mimes:pdf|max:5120'
        ]);

        if (!is_null($this->update_file)) {
            $uri = 'books/'.$this->lesson->id.'/'.$this->book->filename;
            Storage::delete($uri);
            
            $name = Date('YmdHis').'_books.'.$this->update_file->extension();
            $path = Storage::putFileAs('books/'.$this->lesson->id, $this->update_file, $name);

            $this->book->filename = $name;
            $this->book->size = Converter::formatBytes($this->update_file->getSize());

        }
        $this->book->save();
        $this->resetInput();
        $this->setNotif('Successfully updating data.');
    }
    
    public function delete($id)
    {
        $this->setBook($id);
        $course_id = Lesson::where('id', $this->lesson->id)->value('course_id');
        $uri = 'books/'.$course_id.'/'.$this->lesson->id.'/'.$this->book->filename;
        Storage::delete($uri);
        $this->book->delete();
        $this->resetInput();
        $this->setNotif('Successfully deleting data.');
    }

    public function setBook($id)
    {
        $this->book = MsBook::find($id);
        $this->iteration++;
    }

    public function resetInput()
    {
        $this->reset(['title', 'file']);
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
        // dd($orders_id);
        $this->orders_id = $orders_id;
        $this->validate([
            'orders_id.*' => 'integer',
        ]);
        foreach ($this->books as $book) {
            $order = array_search($book->id, $this->orders_id) + 1;
            if($book->orders <> $order) {
                $book->orders = $order;
                $book->save();
            }
        }
        $this->setNotif('Successfully reordering data.');
    }

    
}
