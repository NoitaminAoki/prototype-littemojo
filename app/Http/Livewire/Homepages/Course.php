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
    	$data['courses'] = MdCourse::where([['is_verified', true], ['is_published', true]])
		->orderBy('created_at')			
    	->get();

    	$data['levels']    = Level::select('id', 'name')->get();
    	$data['skills']    = ObtainSkill::select('id', 'name')->get();
    	$data['cat_topics'] = CatalogTopic::select('id', 'name')->get();	
    	// dd($courses);
        return view('livewire.homepages.course')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }
}
