<?php

namespace App\Http\Livewire\Partners\Courses;

use Livewire\Component;
use App\Models\{
    ObtainSkill as Skills,
    CourseSkill,
	Course,
};

class Skill extends Component
{
    protected $rules = [
        'skill.name' => 'required|string',
    ];

    public $skills = [];
    public $skill;
    public $courseSkill;
    public $course_id;

    public $notification = [
        'isOpen' => false, 
        'message' => "",
    ];

    public function mount($course_id)
    {
        $this->course_id  = $course_id;
        $this->skill      = new Skills;
        $this->courseSkill = new CourseSkill;
    }

    public function render()
    {
        $course = Course::select('courses.id', 'courses.catalog_id', 'courses.catalog_topic_id', 'title', 'description', 'price', 'catalog_topics.name as nama_catalog_topic',
        'catalogs.name as nama_catalog')
        ->join('catalog_topics', 'catalog_topics.id', 'courses.id')
        ->join('catalogs', 'catalogs.id', 'catalog_topics.catalog_id')
        ->findOrFail($this->course_id);

        $this->skills = CourseSkill::where('course_id', $this->course_id)->get();
        
        return view('partners.course.skill.live-index')
        ->with(['course' => $course, 'skills' => $this->skills])
        ->layout('partners.layouts.app-main');
        
    }

    public function insert()
    {
        $this->validate([
            'skill.name' => 'required|string',
        ]);
        $skill = Skills::where('name', 'like', '%'.$this->skill->name.'%')->first();
        $cat = Course::findOrFail($this->course_id)->value('catalog_id');
        if (is_null($skill)) {
            $this->skill->catalog_id = $cat;
            $this->skill->save();
        }        

        $this->courseSkill->course_id = $this->course_id;
        $this->courseSkill->skill_id = (is_null($skill) ? $this->skill->id : $skill->id);
        $this->courseSkill->save();
        $this->resetInput();
        $this->setNotif('Successfully adding data.');
    }

    public function update()
    {
        $this->validate([
            'skill.name' => 'required|string',
        ]);
        $this->skill->save();
        $this->resetInput();
        $this->setNotif('Successfully updating data.');
    }

    public function delete($id)
    {
        $this->setSkill($id);
        $this->skill->delete();
        $this->resetInput();
        $this->setNotif('Successfully deleting data.');
    }

    public function setSkill($id)
    {
        $this->skill = CourseSkill::where('skill_id', $id)->first();
    }
    
    public function resetInput()
    {
        $this->skill = new Skills;
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
}
