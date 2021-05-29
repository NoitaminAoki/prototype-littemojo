<?php

namespace App\Http\Livewire\Homepages;

use Livewire\Component;

use App\Models\{
	Course as MdCourse,
	Level,
	ObtainSkill,
	CatalogTopic
};

class Course extends Component
{
	public $searchCourse, $level_id, $duration, $skill_id, $cat_topic_id;
    public function render()
    {
    	$data['courses'] = MdCourse::where([
					    		['is_verified', true],
					    		['is_published', true]
					    	])
    						->with(['catalogTopic', 'level'])
    						->select('id', 'catalog_topic_id', 'level_id', 'title', 'description', 'price', 'duration')
    						->where('courses.title', 'like', '%'.$this->searchCourse.'%')
    						->when($this->level_id, function($query){
    							$query->where('courses.level_id', $this->level_id);
    						})
    						->when($this->duration, function($query){
    							$query->where('courses.duration', $this->duration);
    						})
    						->when($this->skill_id, function($query){
    							$query->where('courses.skill_id', $this->skill_id);
    						})
    						->when($this->cat_topic_id, function($query){
    							$query->where('courses.catalog_topic_id', $this->cat_topic_id);
    						})			
    						->get();

    	$data['levels']    = Level::select('id', 'name')->get();
    	$data['skills']    = ObtainSkill::select('id', 'name')->get();
    	$data['cat_topics'] = CatalogTopic::select('id', 'name')->get();	
    	// dd($courses);
        return view('livewire.homepages.course')
        			->with($data)
        			->layout('homepage.lv-layouts.lv-main');
    }
}
