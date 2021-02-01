<?php

namespace App\Http\Livewire\Partners\Courses;

use Livewire\Component;
use App\Models\{
    GainedExperience as Experiences,
	Course,
};
use Illuminate\Support\Arr;

class Experience extends Component
{
    protected $listeners = ['liveInsert' => 'insert'];

    public $name = '';
    
    public $experiences = [];
    
    public $course_id;

    public $isInserted = false;
    
    public function mount($course_id)
    {
        $this->course_id = $course_id;
    }
    
    public function render()
    {
        $course = Course::select('courses.id', 'courses.catalog_id', 'courses.catalog_topic_id', 'title', 'description', 'price', 'catalog_topics.name as nama_catalog_topic',
        'catalogs.name as nama_catalog')
        ->join('catalog_topics', 'catalog_topics.id', 'courses.id')
        ->join('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
        ->findOrFail($this->course_id);

        $this->experiences = Experiences::where('course_id', $this->course_id)->get();

        return view('partners.course.experience.index')
        ->with(['course' => $course, 'experiences' => $this->experiences])
        ->layout('partners.layouts.app-main');
    }

    public function insert()
    {
        $experience = Experiences::create([
            'course_id' => $this->course_id,
            'name' => $this->name
        ]);
        $this->isInserted = true;
        $this->reset('name');
    }
}
