<?php

namespace App\Http\Livewire\Partners\Courses\Lessons;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    CourseLesson as Lesson,
    LessonVideo as MsVideo
};
use App\Helpers\Converter;

class Video extends Component
{
    use WithFileUploads;

    protected $rules = [
        'title' => 'required|string',
        'file' => 'required|file|mimes:mp4,mkv|max:102400',
        'video.title' => 'required|string',
        'update_file' => 'mimes:mp4,mkv|max:102400',
    ];
    
    public $orders_id;

    public $notification = [
        'isOpen' => false, 
        'message' => "",
    ];

    public $isOpenOrder = false;

    public $lesson;
    public $video;
    public $videos;

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
        $this->videos = MsVideo::where('lesson_id', $this->lesson->id)->orderBy('orders', 'asc')->get();
        return view('partners.course.lesson.video.live-index')
        ->with(['books' => $this->videos])
        ->layout('partners.layouts.app-main');
    }

    public function upload()
    {
        if ($this->course_user_id == $this->user_id) {
            $this->validate([
                'title' => 'required|string',
                'file' => 'required|mimes:mp4,mkv|max:102400'
            ]);

            $name = Date('YmdHis').'_videos.'.$this->file->extension();
            $course_id = Lesson::where('id', $this->lesson->id)->value('course_id');

            $path = Storage::putFileAs('videos/'.$course_id.'/'.$this->lesson->id, $this->file, $name);

            $last_video = MsVideo::where('lesson_id', $this->lesson->id)->orderBy('orders', 'desc')->first();

            $order = 1;

            if($last_video) {
                $order += $last_video->orders;
            }
            $getid3 = new \getID3;
            $video = $getid3->analyze(storage_path('app/videos/'.$course_id.'/'.$this->lesson->id.'/'.$name));
            
            MsVideo::create([
                'lesson_id' => $this->lesson->id,
                'user_id' => $this->user_id,
                'uuid' => Str::uuid(),
                'title' => $this->title,
                'orders' => $order,
                'filename' => $name,
                'duration' => round($video['playtime_seconds']),
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
            'video.title' => 'required|string',
            'update_file' => 'nullable|mimes:mp4,mkv|max:102400'
        ]);

        if (!is_null($this->update_file)) {
            $uri = 'videos/'.$this->lesson->id.'/'.$this->video->filename;
            Storage::delete($uri);
            
            $name = Date('YmdHis').'_videos.'.$this->update_file->extension();
            $path = Storage::putFileAs('videos/'.$this->lesson->id, $this->update_file, $name);

            $getid3 = new \getID3;
            $course_id = Lesson::where('id', $this->lesson->id)->value('course_id');
            $video = $getid3->analyze(storage_path('app/videos/'.$course_id.'/'.$this->lesson->id.'/'.$name));
            $this->video->filename = $name;
            $this->video->duration = round($video['playtime_seconds']);
            $this->video->size = Converter::formatBytes($this->update_file->getSize());

        }
        $this->video->save();
        $this->resetInput();
        $this->setNotif('Successfully updating data.');
    }
    
    public function delete($id)
    {
        $this->setVideo($id);
        $course_id = Lesson::where('id', $this->lesson->id)->value('course_id');
        $uri = 'videos/'.$course_id.'/'.$this->lesson->id.'/'.$this->video->filename;
        Storage::delete($uri);
        $this->video->delete();
        $this->resetInput();
        $this->setNotif('Successfully deleting data.');
    }

    public function setVideo($id)
    {
        $this->video = MsVideo::find($id);
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
        foreach ($this->videos as $video) {
            $order = array_search($video->id, $this->orders_id) + 1;
            if($video->orders <> $order) {
                $video->orders = $order;
                $video->save();
            }
        }
        $this->setNotif('Successfully reordering data.');
    }

    
}
