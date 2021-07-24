<?php

namespace App\Http\Livewire\Homepages;

use Livewire\Component;
use Illuminate\Support\Arr;
use App\Helpers\Converter;
use App\Models\{
	Course as MdCourse,
	Level,
	Catalog,
	CatalogTopic
};

class Course extends Component
{
	public $skill_id, $cat_topic_id;

	public $title = '';
	public $page = 1;
	public $limit_data = 0;
	public $total_page;
	
	protected $queryString = [
        'title' => ['except' => ''],
		'page' => ['except' => 1],
    ];

	public $input_name;
	public $filter_data;
	public $level_id, $duration, $catalog_id, $topic_id;

	public function mount()
	{
		$this->input_name = $this->title;

		$this->limit_data = 10;
	}

    public function render()
    {
		$limit = $this->limit_data;
		$total_data = MdCourse::where([['is_verified', true], ['is_published', true]])
		->when($this->title, function ($query, $title)
		{
			return $query->where('title', 'like', '%'.$title.'%');
		})
		->when($this->filter_data, function ($query, $filter_data)
		{
			return $query->where($filter_data);
		})->count();
		$total_page = (int) ceil($total_data / $this->limit_data);
		if($total_page > 10) {
			$total_page = 10;
		}

		if ($this->page > $total_page) {
			$this->page = $total_page;
		}

		$this->total_page = $total_page;
		
		$offset = Converter::pageToOffset($this->page, $limit);
		

		$query_course = MdCourse::where([['is_verified', true], ['is_published', true]])
		->when($this->title, function ($query, $title)
		{
			return $query->where('title', 'like', '%'.$title.'%');
		})
		->when($this->filter_data, function ($query, $filter_data)
		{
			return $query->where($filter_data);
		})
		->when($offset, function ($query, $offset) use ($limit)
		{
			return $query->offset($offset);
		})
		->limit($limit)
		->orderBy('created_at')->get();
		$data['courses'] = $query_course;
		// dd($total_page, $total_data);
    	$data['levels']    = Level::select('id', 'name')->get();
    	$data['catalogs']    = Catalog::orderBy('name', 'asc')->get();
		$data['cat_topics'] = [];
        return view('livewire.homepages.course')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }

	public function changeCatalog($id)
	{
		$this->catalog_id = $id;
		if(!$id) {
			$this->topic_id = "";
		}
		$topics = CatalogTopic::select('id', 'name as text')->where('catalog_id', $this->catalog_id)->orderBy('name', 'asc')->get();

		return $this->dispatchBrowserEvent('select2:change', ['id' => '#topic_select2', 'data' => $topics, 'text_empty' => "Choose Catalog First"]);
	}

	public function filterCourse()
	{
		$filter = [];

		if($this->level_id) {
			$filter['level_id'] = $this->level_id;
		}
		if($this->duration) {
			$filter['duration'] = $this->duration;
		}
		if($this->catalog_id) {
			$filter['catalog_id'] = $this->catalog_id;
		}
		if($this->topic_id) {
			$filter['catalog_topic_id'] = $this->topic_id;
		}
		$this->filter_data = $filter;
		$this->page = 1;
	}

	public function searchCourse()
	{
		$this->title = $this->input_name;
		$this->page = 1;
	}

	public function goToPage($page)
	{
		if($page < 1) {
			$page = 1;
		}
		$this->page = $page;
	}
}
