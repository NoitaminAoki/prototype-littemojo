<?php

namespace App\Http\Livewire\Partners\Courses\Lessons;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\LessonBook as Books;

class Book extends Component
{
    use WithFileUploads;

    public $photo;
    public $iteration;

    public function render()
    {
        $books = Books::all();
        return view('partners.course.lesson.book.live-index')
        ->with(['books' => $books])
        ->layout('partners.layouts.app-main');
    }

    public function upload()
    {
        $this->validate([
            'photo' => 'required|mimes:pdf|max:5120'
        ]);

        $name = Date('YmdHis').'_books.'.$this->photo->extension();

        $path = Storage::putFileAs('books', $this->photo, $name);

        Books::create([
            'lesson_id' => 0,
            'uuid' => Str::uuid(),
            'orders' => 1,
            'filename' => $name
        ]);
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset('photo');
        $this->iteration++;
    }
}
