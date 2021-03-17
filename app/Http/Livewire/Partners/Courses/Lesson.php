<?php

namespace App\Http\Livewire\Partners\Courses;

use Livewire\Component;
use App\Models\{
	CourseLesson,
	Course
};

class Lesson extends Component
{
	protected $rules = [
		'lesson.title' 		 => 'required|string',
		'lesson.description' => 'required|string',
	];

	public $lessons = [];
	public $lesson;
	public $course_id;

	public $notification = [
		'isOpen' => false, 
		'message' => "",
	];

	public function mount($course_id)
	{
		$this->course_id = $course_id;
		$this->lesson = new CourseLesson;
	}

	public function render()
	{
		$course = Course::select('courses.id', 'courses.catalog_id', 'courses.catalog_topic_id', 'title', 'description', 'price', 'catalog_topics.name as nama_catalog_topic',
			'catalogs.name as nama_catalog')
		->join('catalog_topics', 'catalog_topics.id', 'courses.id')
		->join('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
		->findOrFail($this->course_id);

		$this->lessons = CourseLesson::where('course_id', $this->course_id)->get();

		return view('partners.course.lesson.live-index')
		->with(['course' => $course, 'lessons' => $this->lessons])
		->layout('partners.layouts.app-main');

	}

	public function insert()
	{
		$this->validate([
			'lesson.title' 		 => 'required|string',
			'lesson.description' => 'required|string',
		]);
		$this->lesson->course_id = $this->course_id;
		$this->lesson->save();
		$this->resetInput();
		$this->setNotif('Successfully adding data.');
	}

	public function setLesson($id)
    {
        $this->lesson = CourseLesson::find($id);
    }

    public function update()
    {
        $this->validate([
            'lesson.title' 		 => 'required|string',
			'lesson.description' => 'required|string',
        ]);
        $this->lesson->save();
        $this->resetInput();
        $this->setNotif('Successfully updating data.');
    }

    public function delete($id)
    {
        $this->setLesson($id);
        if (\Storage::exists('books/'.$this->lesson->course_id.'/'.$this->lesson->id))
        	\Storage::deleteDirectory('books/'.$this->lesson->course_id.'/'.$this->lesson->id);

        if (\Storage::exists('videos/'.$this->lesson->course_id.'/'.$this->lesson->id))
        	\Storage::deleteDirectory('videos/'.$this->lesson->course_id.'/'.$this->lesson->id);

        if (\Storage::exists('images/questions/'.$this->lesson->course_id.'/lesson_'.$this->lesson->id))
        	\Storage::deleteDirectory('images/questions/'.$this->lesson->course_id.'/lesson_'.$this->lesson->id);
        $this->lesson->delete();
        $this->resetInput();
        $this->setNotif('Successfully deleting data.');
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

	public function resetInput()
	{
		$this->lesson = new CourseLesson;
	}
}
